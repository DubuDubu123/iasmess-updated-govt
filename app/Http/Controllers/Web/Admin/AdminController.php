<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\Driver\CreateDriverRequest;
use App\Http\Requests\Admin\Driver\UpdateDriverRequest;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Admin\AdminDetail;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Models\User;
use App\Models\Admin\Driver;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Requests\Admin\AdminDetail\CreateAdminRequest;
use App\Http\Requests\Admin\AdminDetail\UpdateAdminRequest;
use App\Http\Requests\Admin\AdminDetail\UpdateProfileRequest;
use App\Models\Admin\Company;
use App\Models\Country;
use App\Models\UsersMembership; 
use App\Models\Access\Role;
use App\Models\Admin\ServiceLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\DriversImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use App\Base\Libraries\SMS\SMSContract;

/**
 * @resource Driver
 *
 * vechicle types Apis
 */
class AdminController extends BaseController
{
    /**
     * The Driver model instance.
     *
     * @var \App\Models\Admin\AdminDetail
     */
    protected $admin_detail;

    /**
     * The User model instance.
     *
     * @var \App\Models\User
     */
    protected $user;
     protected $smsContract;

    /**
     * The
     *
     * @var App\Base\Services\ImageUploader\ImageUploaderContract
     */
    protected $imageUploader;


    /**
     * DriverController constructor.
     *
     * @param \App\Models\Admin\AdminDetail $admin_detail
     */
    public function __construct(AdminDetail $admin_detail, ImageUploaderContract $imageUploader, User $user,SMSContract $smsContract)
    {
        $this->admin_detail = $admin_detail;
        $this->imageUploader = $imageUploader;
        $this->user = $user;
        $this->smsContract = $smsContract;
    }

    /**
    * Get all admins
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.admins');

        $main_menu = 'settings';
        $sub_menu = 'admin';
        $sub_menu_1 = '';
        
        return view('admin.admin.index', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }

public function getAllAdmin(QueryFilterContract $queryFilter)
{
    $url = request()->fullUrl(); // Get full URL

    if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
        $query = AdminDetail::query();
        if (env('APP_FOR') == 'demo') {
            $query = AdminDetail::whereHas('user', function ($query) {
                $query->where('company_key', auth()->user()->company_key);
            });
        }
    } else {
        $this->validateAdmin();
        $query = $this->admin_detail->where('created_by', $this->user->id);
    }

    // Join with the users and roles tables to get the required details
    $query->join('users', 'admin_details.user_id', '=', 'users.id')
          ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
          ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
          ->select([
              'admin_details.id',
              'users.name',  // Fetching the name from the users table
              'users.email',
              'roles.name as role_name', // Fetching the role name from the roles table
              'users.active',
              'admin_details.created_by', 
              'admin_details.updated_by',
          ]);

    $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

    return view('admin.admin._admin', compact('results'));
}






    /**
    * Create Admins View
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_admin');
        $admins = User::companyKey()->doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();

        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $roles = Role::whereIn('slug', RoleSlug::adminRoles())->get();
        } else {
            $this->validateAdmin();
            $roles = Role::whereIn('slug', RoleSlug::exceptSuperAdminRoles())->get();
        }

        $countries = Country::active()->get();
        $services = ServiceLocation::companyKey()->active()->get();

        $main_menu = 'settings';
        $sub_menu = 'admin';
        $sub_menu_1 = '';

        return view('admin.admin.create', compact('admins', 'page', 'countries', 'main_menu', 'sub_menu','sub_menu_1', 'roles', 'services'));
    }

    /**
     * Store admin.
     *
     * @param \App\Http\Requests\Admin\Driver\CreateDriverRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
  public function store(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:5120' // max 5MB
    ]);

    // Check if the request is for demo environment
    if (env('APP_FOR') == 'demo') {
        return redirect()->back()->with('warning', trans('succes_messages.you_are_not_authorised'));
    }

    // Check for existing email
    if ($request->role == "mess-manager") {
        $admins = User::where('email', $request->email)
                      ->doesNotBelongToRole(RoleSlug::MESS_MANAGER)
                      ->get();
    } else {
        $admins = User::where('email', $request->email)
                      ->doesNotBelongToRole(RoleSlug::SUPER_ADMIN)
                      ->get();
    }

    if ($admins->count() > 0) {
        return redirect()->back()->with('warning', 'Email Address already exists');
    }

    // Create user parameters
    $user_params = [
        'name' => $request->input('first_name'),
        'email' => $request->input('email'),
        'mobile_confirmed' => true,
        'password' => bcrypt($request->input('password')),
    ];

    if (env('APP_FOR') == 'demo') {
        $user_params['company_key'] = auth()->user()->company_key;
    }

    // Create user
    $user = $this->user->create($user_params);

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        try {
            $uploadedFile = $request->file('profile_picture');
            $user->profile_picture = $this->imageUploader->file($uploadedFile)->saveProfilePicture();
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload profile picture.')->withInput();
        }
    }

    // Attach role and create admin record
    $user->attachRole($request->role);
    $created_params = $request->only(['first_name', 'email', 'city']);
    $created_params['created_by'] = auth()->user()->id;
    $user->admin()->create($created_params);

    return redirect()->back()->with('success', trans('succes_messages.admin_added_succesfully'));
}



    public function getById(AdminDetail $admin)
    {
        

        $page = trans('pages_names.edit_admin');

        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
            $roles = Role::whereIn('slug', RoleSlug::adminRoles())->get();
        } else {
            $this->validateAdmin();
            $roles = Role::whereIn('slug', RoleSlug::adminRoles())->get();
        }
        $services = ServiceLocation::active()->get(); 
        $item = $admin;
        $main_menu = 'settings';
        $sub_menu = 'admin';
        $sub_menu_1 = '';

        return view('admin.admin.update', compact('item', 'services', 'page', 'main_menu', 'sub_menu','sub_menu_1', 'roles'));
    }


    public function update(AdminDetail $admin, Request $request)
    {
        // dd("testt");
        // dd($request->all());   
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('admins')->with('warning', $message);
        } 
        if($request->role == "mess-manager")
        { 
            $admins = User::where('email',$request->email)->doesNotBelongToRole(RoleSlug::MESS_MANAGER)->get();
        }
        else{
            $admins = User::where('email',$request->email)->doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get(); 
        } 
        if(count($admins) > 0)
        {
              return redirect('admins/edit/'.$admin->id.'')->with('warning', 'Email Address already Exists'); 
        }
        $updatedParams = $request->only(['first_name','email','city']);
        $updatedParams['pincode'] = $request->postal_code;
       
        $updatedParams['updated_by'] = auth()->user()->id;

        $updated_user_params = ['name'=>$request->input('first_name'),
            'email'=>$request->input('email'), 
            'password' => bcrypt($request->input('password'))
        ]; 
       

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $updated_user_params['profile_picture'] = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }

        $admin->user->update($updated_user_params);

        $admin->user->roles()->detach();

        $admin->user->attachRole($request->role);
        // dd($admin);
        $admin->update($updatedParams);

        $message = trans('Profile Details Updated Successfully ');
        return redirect('admins')->with('success', $message);
    }
    public function toggleStatus(User $user)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('admins')->with('warning', $message);
        }
        
        $status = $user->isActive() ? false: true;
        $user->update(['active' => $status]);

        $message = trans('succes_messages.admin_status_changed_succesfully');
        return redirect('admins')->with('success', $message);
    }

    public function delete(User $user)
    {
        if(env('APP_FOR')=='demo'){

        $message = 'you cannot perform this action due to demo version';
        
        return $message;

        }
        $user->delete();

        $message = trans('succes_messages.admin_deleted_succesfully');

        return $message;
        // return redirect('admins')->with('success', $message);
    }

    public function viewProfile(User $user)
    {
         //dd($user);
        $page = trans('pages_names.admins');

        $main_menu = 'settings';
        $sub_menu = 'admin';
        $sub_menu_1 = '';
        $membership_data = UsersMembership::where('user_id',$user->id)->limit(1)->first();

        return view('admin.admin.profile', compact('page', 'main_menu', 'sub_menu', 'sub_menu_1', 'user','membership_data'));
    }

public function updateProfile(Request $request, User $user)
{
    if (env('APP_FOR') == 'demo') {
        return response()->json(['success' => false, 'message' => 'You cannot update the profile due to demo version'], 200);
    }

    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'mobile' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:5120' // max 5MB
    ]);

    $updated_user_params = [
        'name' => $request->input('first_name'),
        'email' => $request->input('email'),
        'mobile' => $request->input('mobile'),
        'address' => $request->input('address')
    ];

    // Update user details
    $user->update($updated_user_params);

    // Handle profile picture upload directly
    if ($request->hasFile('profile_picture')) {
        try {
            $uploadedFile = $request->file('profile_picture');
            $user->profile_picture = $this->imageUploader->file($uploadedFile)->saveProfilePicture();
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to upload profile picture.'], 500);
        }
    }

    // Handle password update if requested
    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->save();
    }
    
    $phoneNumber = $user->mobile;
    
    
   $message_update = "Dear+".urlencode($user->name)."%2C%0AYour+profile+information+has+been+successfully+updated+in+the+IAS+Officers+Mess+system.+If+you+did+not+make+these+changes%2C+please+contact+DS+Protocol+office+for+assistance.";
    
   
    $response_update = $this->smsContract->whatsappsend($phoneNumber, $message_update);
//dd($message_update);
     // Send WhatsApp update message
    //dd($phoneNumber);
    //dd($message_update);
    //$mobile=8056496398;
   
   

    return response()->json([
        'success' => true,
        'redirectUrl' => url('admins/profile/' . $user->id),
        'message' => 'Profile Details Updated Successfully'
    ], 200);
}



// public function uploadImage(Request $request)
// {
//     // Validate the uploaded file
//     $request->validate([
//         'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     // Get the uploaded file
//     $file = $request->file('profile_picture');

//     // Generate a unique filename
//     $fileName = time() . '_' . $file->getClientOriginalName();

//     // Define the destination path
//     $destinationPath = public_path('profile_pictures');

//     // Move the file to the public/profile_pictures directory
//     $file->move($destinationPath, $fileName);

//     // Update the user's profile picture in the database
//     $user = User::find($request->input('user_id'));
//     $user->profile_picture = $fileName; // Store only the filename
//     $user->save();

//     // Generate URL for the new image
//     $newImageUrl = asset('profile_pictures/' . $fileName);

//     return response()->json([
//         'success' => true,
//         'message' => 'Image uploaded successfully!',
//         'new_image_url' => $newImageUrl,
//     ], 200);
// }






public function updatepassword(UpdateProfileRequest $request, User $user)
{
    //dd($request);
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->raw_p = $request->input('password');
        $user->save();
        $phoneNumber = $user->mobile;
           $message = "IAS Mess: Shri {$user->name}, Welcome to IAS Officers' Mess online reservation system. your profile was updated successfully, Your Username : {$user->userid}, Password : {$request->password}, (For security reasons, change your password)-TNPROT";
    $apiId = 1007986856263760889;
    //$phoneNumber = $bookings_mobile;  // Replace with the appropriate variable if needed

    $data = $this->smsContract->send1($phoneNumber, $message, $apiId);
    
    // print_r($data);
    
   $message1="IAS+Mess%3A+Sir%2FMadam%2C+Welcome+to+IAS+Officers%27+Mess+online+reservation+system.+Username%3A+".urlencode($user->userid)."%2CPassword+%3A+".urlencode($request->password)."%2C+%28For+security+reasons%2C+change+your+password%29+Refer+Your+registered+e-mail+for+further+details+-+TNPROT";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile 
    }
    
 //dd($message1);
 
 
//   $phoneNumber = $user->mobile;
    
    
   $message_update_pass = "Dear+".urlencode($user->name)."%2C%0AYour+profile+information+has+been+successfully+updated+in+the+IAS+Officers+Mess+system.+If+you+did+not+make+these+changes%2C+please+contact+DS+Protocol+office+for+assistance.";
    
   
    $response_update_pass = $this->smsContract->whatsappsend(8056496398, $message_update_pass);
    //dd($response_update_pass);
    
    $message = trans('Profile Details Updated Successfully ');
   return redirect('admins/profile/' . $user->id)->with('success', $message);
}

}
