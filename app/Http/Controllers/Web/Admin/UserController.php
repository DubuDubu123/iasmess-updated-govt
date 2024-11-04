<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Models\Admin\Driver;
use App\Models\MembershipTariff;
use App\Models\Admin\Company;
use App\Base\Constants\Auth\Role;
use App\Models\Admin\UserDetails;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\BaseController;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Request\Request as RequestRequest;
use App\Base\Filters\Admin\RequestFilter;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\UserWallet;
use App\Http\Requests\Admin\User\AddUserMoneyToWalletRequest;
use App\Base\Constants\Setting\Settings;
use Illuminate\Support\Str;
use App\Base\Constants\Masters\WalletRemarks;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\Notifications\SendPushNotification;
use Mail;
use Illuminate\Http\Request;
use App\Jobs\Notifications\Auth\Registration\UserNotification;
use App\Base\Libraries\SMS\SMSContract;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\MobileOtp;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use DB;
class UserController extends BaseController
{
    /**
     * The User Details model instance.
     *
     * @var \App\Models\Admin\UserDetails
     */
    protected $user_details ;

    /**
     * The User model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The
     *
     * @var App\Base\Services\ImageUploader\ImageUploaderContract
     */
    protected $imageUploader;


    /**
     * User Details Controller constructor.
     *
     * @param \App\Models\Admin\UserDetails $user_details
     */
 use ExceptionHelpers;
    /**
     * The OTP handler instance.
     *
     * @var \App\Base\Services\OTP\Handler\OTPHandlerContract
     */
    protected $otpHandler;

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    
    protected $smsContract;



     
    public function __construct(User $user, OTPHandlerContract $otpHandler, SMSContract $smsContract,ImageUploaderContract $imageUploader)
    {
        $this->user = $user;
        $this->otpHandler = $otpHandler; 
        $this->smsContract = $smsContract;
        $this->imageUploader = $imageUploader; 
    }

    /**
    * Get all users
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.users');

        $main_menu = 'users';
        $sub_menu = 'user_details';
        $sub_menu_1 = 'active_user';

        return view('admin.users.index', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }

    /**
    * Get all users
    * @return \Illuminate\Http\JsonResponse
    */
    public function view(User $user)
    {
        $page = trans('pages_names.users'); 
        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = 'active_user';
        $membership_tariff = MembershipTariff::get(); 
        return view('admin.users.view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','user','membership_tariff'));
    }

    public function getAllUser(QueryFilterContract $queryFilter)
    {
        $url = request()->fullUrl(); //get full url

        $query = User::where('active', true)->where('is_deleted', false)->where('is_approve', 0)->belongsToRole(RoleSlug::USER);
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.users._user', compact('results'));
    }
//searchUser
public function searchUser(QueryFilterContract $queryFilter)
{
    $search_keyword = request()->query('search'); // Get search keyword

    $query = User::where('active', true)
        ->where('is_deleted', false)
        ->where('is_approve', 0)
        ->where(function ($q) use ($search_keyword) {
            $q->where('name', 'like', "%$search_keyword%")
              ->orWhere('email', 'like', "%$search_keyword%");
        })
        ->belongsToRole(RoleSlug::USER);

    $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

    return view('admin.users._user', compact('results'));
}



    public function indexDeleted()
    {
        $page = trans('pages_names.users');

        $main_menu = 'users';
        $sub_menu = 'deceased';
        $sub_menu_1 = 'deceased';

        return view('admin.users.deleted-index', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }

    public function getAllDeletedUser(QueryFilterContract $queryFilter)
    {
        $url = request()->fullUrl(); //get full url

        $query = User::where('is_deleted', true)->belongsToRole(RoleSlug::USER);
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.users._deleted-user', compact('results'));
    }


/*inactive Users*/
    public function indexInactive()
    {
        $page = trans('pages_names.users');

        $main_menu = 'users';
        $sub_menu = 'approved';
        $sub_menu_1 = 'in_active_user';

        return view('admin.users.inactive-index', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }

    public function getAllInactiveUser(QueryFilterContract $queryFilter)
    {
        $url = request()->fullUrl(); //get full url

        $query = User::where('is_deleted', false)->where('is_approve', 1)->belongsToRole(RoleSlug::USER);
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.users._inactive_user', compact('results'));
    }
/*end*/

    /**
    * Create User View
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_user');

        $countries = Country::active()->get();

        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';

        return view('admin.users.create', compact('page', 'countries', 'main_menu', 'sub_menu','sub_menu_1'));
    }

    /**
     * Create User.
     *
     * @param \App\Http\Requests\Admin\User\CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $created_params = $request->only(['name','mobile','email','country','gender']);
        $created_params['mobile_confirmed'] = true;
        // $created_params['password'] = bcrypt($request->input('password'));

            $created_params['ride_otp'] = rand(1111, 9999);

        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $request->email)->exists();

        $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $request->mobile)->exists();

        if ($validate_exists_email) {
            return redirect()->back()->withErrors(['email'=>'Provided email hs already been taken'])->withInput();
        }
        if ($validate_exists_mobile) {
            return redirect()->back()->withErrors(['mobile'=>'Provided mobile hs already been taken'])->withInput();
        }

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $created_params['profile_picture'] = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }

        $created_params['company_key'] = auth()->user()->company_key;

        $created_params['refferal_code']= str_random(6);

        $created_params['created_by'] = auth()->user()->id;


        $user = $this->user->create($created_params);

        $user->attachRole(RoleSlug::USER);


        $message = trans('succes_messages.user_added_succesfully');

        return redirect('users')->with('success', $message);
    }

    public function getById(User $user)
    {
        $page = trans('pages_names.edit_user');


        $countries = Country::all();
        $results = $user->userDetails ?? $user;
        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';

        return view('admin.users.update', compact('page', 'countries', 'main_menu', 'results', 'sub_menu','sub_menu_1'));
    }


    public function update(User $user, UpdateUserRequest $request)
    {
        $updated_params = $request->only(['name','mobile','email','country','gender']);

        $updated_params['updated_by'] = auth()->user()->id;

        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $updated_params['profile_picture'] = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }

        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $request->email)->where('id', '!=', $user->id)->exists();

        $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $request->mobile)->where('id', '!=', $user->id)->exists();

        if ($validate_exists_email) {
            return redirect()->back()->withErrors(['email'=>'Provided email hs already been taken'])->withInput();
        }
        if ($validate_exists_mobile) {
            return redirect()->back()->withErrors(['mobile'=>'Provided mobile hs already been taken'])->withInput();
        }

        $user->update($updated_params);

        $message = trans('succes_messages.user_updated_succesfully');

        return redirect('users')->with('success', $message);
    }

    public function toggleStatus(User $user)
    {
        $status = $user->active == 1 ? 0 : 1;

        if($status==1)
        {

            $user->update([
                'active' => $status,
                'is_deleted'=>false,
            ]);
        }else{

            $user->update([
                'active' => $status,
            ]);            
        }


        $message = trans('succes_messages.user_status_changed_succesfully');

            $title = trans('push_notifications.account_inactivated_title',[],$user->lang);
            $body = trans('push_notifications.account_inactivated_body',[],$user->lang);
            $push_data =  ['title' => 'account_inactivated','message' => 'account_inactivated','push_type'=>'account_inactivated'];

       dispatch(new SendPushNotification($user,$title,$body,$push_data));

        return redirect('users')->with('success', $message);
    }
    public function confirm(User $user,Request $request)
    {     
            $membership_data = MembershipTariff::find($request->data);
            $user->update([
                'is_paid_online' => 0,
                'is_payment_done' => 1,
                'payment_mode' => $request->payment_mode,
                'is_approve' => 1,
                'is_deleted'=>false,
                'membership_type'=>$request->data,
                'membership_amount'=>$membership_data->price
            ]);   
            $details = [
                'title' => "Mail from IAS Officers' App",
                'user_details' => $user,
                'type' => 'confirm_email'
            ];
           
            // dd($user->email);
            Mail::to($user->email)->send(new UserNotification($details));
  $message1 = "IAS Mess: Sir/Madam, Welcome to IAS Officers' Mess online reservation system. Username: {$user->userid}, Password: {$user->mobile}, (For security reasons, change your password) Refer Your registered e-mail for further details - TNPROT";
    $apiId1 = 1007571722294400025;
  $message2 = "IAS+Mess%3A+Sir%2FMadam%2C+Welcome+to+IAS+Officers%27+Mess+online+reservation+system.+Username%3A+".$user->userid."%2CPassword+%3A+".$user->mobile."%2C+%28For+security+reasons%2C+change+your+password%29+Refer+Your+registered+e-mail+for+further+details+-+TNPROT";
    $this->smsContract->send1($user->mobile, $message1, $apiId1);
    $value = $this->smsContract->whatsappsend($user->mobile, $message2);
    // dd($value);

            // $sender_id = 'KTSHSC';
            // $template_id = '1707168862643740857';
            // $phone = $user->mobile;
            // $msg = "Payment Done Successfully. Your UserId is ".$user->userid." and Password is ".$user->mobile."";
            // $username = 'IndiaklabssOTP';
            // $apikey = '4DE5A-8C990';
            // $uri = 'https://powerstext.in/sms-panel/api/http/index.php';
            // // dd($phone);
            // // Construct the URL with query parameters
            // $url = $uri . '?' . http_build_query(array(
            //     'username' => $username,
            //     'apikey' => $apikey,
            //     'apirequest' => 'Text',
            //     'sender' => $sender_id,
            //     'route' => 'OTP',
            //     'format' => 'JSON',
            //     'message' => $msg,
            //     'mobile' => $phone,
            //     'TemplateID' => $template_id,
            // ));
            
            // $ch = curl_init();
            
            // // Set the URL
            // curl_setopt($ch, CURLOPT_URL, $url);
            
            // // Set the HTTP method to GET (since we're sending data in the URL)
            // curl_setopt($ch, CURLOPT_HTTPGET, true);
            
            // // Set CURLOPT_RETURNTRANSFER so that curl_exec returns the response
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // $response = curl_exec($ch);
            
            // // Check for errors
            // if(curl_errno($ch)) {
            //     // echo 'Curl error: ' . curl_error($ch);
            //     $response = [
            //         'status' => true,
            //         'message' => curl_error($ch)
            //     ];
            //     return response()->json($response);
            // } else {
            //     // Process the response
            //     // echo $response;
            // }
            
            // // Close the cURL handle
            // curl_close($ch);
            $response = [
                'status' => true,
                'message' => 'Confirmed'
            ];
            return response()->json($response);
    }
public function approve(User $user)
{
    // Generate a unique token for the payment link
    $token = Str::random(32);
    $user->update(['payment_link' => $token]);

    // Prepare the email details
    $details = [
        'title' => "Mail from IAS Officers' App",
        'user_details' => $user,
        'type' => 'membership'
    ];

    // Send the email with the payment link
    Mail::to($user->email)->send(new UserNotification($details));

    // Prepare the SMS message
    $message = "IAS Officers' Mess: Dear {$user->name}, We are pleased to inform you that your membership form, with reference to registration ID {$user->userid}, has been verified successfully. To complete the process, please pay your membership fees. The payment link is provided in the email sent to you.";
    $apiId = 1007345074381075779;

    // Send the SMS
    $phoneNumber = $user->mobile; // Assuming 'mobile' is the column name for phone number
    //dd($phoneNumber);
    $this->smsContract->send1($phoneNumber, $message, $apiId);
    
     $message1="IAS+Officers%27+Mess%3A+Dear+".urlencode($user->name)."%2C+We+are+pleased+to+inform+you+that+your+membership+form%2C+with+reference+to+registration+ID+".$user->userid."+has+been+verified+successfully.+To+complete+the+process%2C+please+pay+your+membership+fees.+The+payment+link+is+provided+in+the+email+sent+to+you."; 
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
    // dd($response);
    // Prepare the response 
    $response = [
        'status' => true,
        'message' => 'Approved and SMS sent.'
    ];

    return response()->json($response);
}

     public function payment_link1(User $user,$payment_link)
    {
        $get_membership_data = UsersMembership::where('user_id',$user->id)->where('is_paid',0)->orderBy('created_at','DESC')->limit(1)->first();
        if($get_membership_data)
        {
             $orderid = "user-$user->id-" . rand(10000, 90000); 
             $MerchantId = "1000356"; 
             $amount = $get_membership_data->amount;
             $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
             $SuccessUrl = url('/')."success"; 
             $FailUrl = url('/')."failed"; 
             $requestParameter  = "$MerchantId|DOM|IN|INR|$amount|Other|$SuccessUrl|$FailUrl|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
             $multi_parameter = "$amount|INR|GRPT";
             $EncryptTrans = $this->encrypt($requestParameter,$key); 
             $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key);
             return view('Payment-link', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls','user','get_membership_data')); 
        }
        
    }
    public function toggleApprove(User $user, $approval_status)
    {
        $user_id = auth()->user()->id;

        $status = (boolean)$approval_status;

        $user->update([
            'approve' => $status,
            'updated_by' => $user_id,
            'is_deleted'=>false,
            
        ]);
        
       $this->database->getReference('users/user_'.$driver->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $message = trans('succes_messages.user_approve_status_changed_succesfully');
        $user = User::find($user->user_id);
        if ($status) {
            $title = trans('push_notifications.user_approved',[],$user->lang);
            $body = trans('push_notifications.user_approved_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::USER_ACCOUNT_APPROVED];
            $socket_success_message = PushEnums::USER_ACCOUNT_APPROVED;
        } else {
            $title = trans('push_notifications.user_declined_title',[],$user->lang);
            $body = trans('push_notifications.user_declined_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::USER_ACCOUNT_DECLINED];
            $socket_success_message = PushEnums::USER_ACCOUNT_DECLINED;
        }

        $user_details = $user->user;
        $user_result = fractal($user_details, new UserTransformer);
        $formated_user = $this->formatResponseData($user_result);
        // dd($formated_user);
        $socket_params = $formated_user['data'];
        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = $socket_success_message;
        $socket_data->data  = $socket_params;


        dispatch(new SendPushNotification($user,$title,$body));

        return redirect('users')->with('success', $message);
    }
    public function toggleAvailable(User $user)
    {
        $status = $user->available == 1 ? 0 : 1;
        $user->update([
            'available' => $status
        ]);

        $message = trans('succes_messages.user_available_status_changed_succesfully');
        return redirect('users')->with('success', $message);
    }
public function delete(User $user)
{
    // Check if the app is in demo mode
    if (env('APP_FOR') == 'demo') {
        $message = 'You cannot delete the user. This is a demo version.';
        return $message;
    }

    // Mark the user as deleted and inactive
    $user->update(['is_deleted' => true, 'active' => false]);

    // Update the status to 2 in related tables where the user_id matches the user's id
    DB::table('room_booking')
        ->where('user_id', $user->id)
        ->update(['status' => 2]);

    DB::table('party_booking')
        ->where('user_id', $user->id)
        ->update(['status' => 2]);

    DB::table('sports_booking')
        ->where('user_id', $user->id)
        ->update(['status' => 2]);

    // Return success message
    $message = trans('success_messages.user_deleted_successfully');
    return $message;
}

   public function UserTripRequestIndex(User $user)
    {

        $completedTrips = RequestRequest::where('user_id',$user->id)->companyKey()->whereIsCompleted(true)->count();
        $cancelledTrips = RequestRequest::where('user_id',$user->id)->companyKey()->whereIsCancelled(true)->count();

        $card = [];
        $card['completed_trip'] = ['name' => 'trips_completed', 'display_name' => 'Completed Rides', 'count' => $completedTrips, 'icon' => 'fa fa-flag-checkered text-green'];
        $card['cancelled_trip'] = ['name' => 'trips_cancelled', 'display_name' => 'Cancelled Rides', 'count' => $cancelledTrips, 'icon' => 'fa fa-ban text-red'];

        $main_menu = 'users_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';
        $items = $user->id;

        return view('admin.users.user-request-list-new', compact('card','main_menu','sub_menu','items','sub_menu_1'));
    }
    public function UserTripRequestNew(QueryFilterContract $queryFilter, User $user)
    {
        $items = $user->id;
       
        $query = RequestRequest::where('requests.user_id', $user->id); // Specify 'requests.user_id' to resolve ambiguity
        
        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.users.user-request-list-view-new', compact('results', 'items'));
    }
    public function UserTripRequest(QueryFilterContract $queryFilter, User $user)
    {
       
        $completedTrips = RequestRequest::where('user_id',$user->id)->companyKey()->whereIsCompleted(true)->count();
        $cancelledTrips = RequestRequest::where('user_id',$user->id)->companyKey()->whereIsCancelled(true)->count();
        $upcomingTrips = RequestRequest::where('user_id',$user->id)->companyKey()->whereIsLater(true)->whereIsCompleted(false)->whereIsCancelled(false)->whereIsDriverStarted(false)->count();

        $card = [];
        $card['completed_trip'] = ['name' => 'trips_completed', 'display_name' => 'Completed Rides', 'count' => $completedTrips, 'icon' => 'fa fa-flag-checkered text-green'];
        $card['cancelled_trip'] = ['name' => 'trips_cancelled', 'display_name' => 'Cancelled Rides', 'count' => $cancelledTrips, 'icon' => 'fa fa-ban text-red'];
        $card['upcoiming_trip'] = ['name' => 'trips_cancelled', 'display_name' => 'Upcoming Rides', 'count' => $upcomingTrips, 'icon' => 'fa fa-calendar'];

        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';



         $query = RequestRequest::where('user_id',$user->id);
        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();


        return view('admin.users.user-request-list', compact('results','card','main_menu','sub_menu','sub_menu_1'));
    }
    public function UserTripRequestView(QueryFilterContract $queryFilter, User $user)
    {
        $items = $user->id;

        $query = RequestRequest::where('user_id',$user->id);
        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

        return view('admin.users.user-request-list-view', compact('results','items'));
    }
    public function userPaymentHistory(User $user)
    {
        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';
        $item = $user;

        $amount = UserWallet::where('user_id',$user->id)->first();

    if ($amount == null) {
         $card = [];
         $card['total_amount'] = ['name' => 'total_amount', 'display_name' => 'Total Amount ', 'count' => "0", 'icon' => 'fa fa-flag-checkered text-green'];
        $card['amount_spent'] = ['name' => 'amount_spent', 'display_name' => 'Spend Amount ', 'count' => "0", 'icon' => 'fa fa-ban text-red'];
        $card['balance_amount'] = ['name' => 'balance_amount', 'display_name' => 'Balance Amount', 'count' => "0", 'icon' => 'fa fa-ban text-red'];

         $history = UserWalletHistory::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        }else{

         $card = [];
        $card['total_amount'] = ['name' => 'total_amount', 'display_name' => 'Total Amount ', 'count' => $amount->amount_added, 'icon' => 'fa fa-flag-checkered text-green'];
        $card['amount_spent'] = ['name' => 'amount_spent', 'display_name' => 'Spend Amount ', 'count' => $amount->amount_spent, 'icon' => 'fa fa-ban text-red'];
        $card['balance_amount'] = ['name' => 'balance_amount', 'display_name' => 'Balance Amount', 'count' => $amount->amount_balance, 'icon' => 'fa fa-ban text-red'];

         $history = UserWalletHistory::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);

        // dd($history);
        }
        return view('admin.users.user-payment-wallet', compact('card','main_menu','sub_menu','item','history','sub_menu_1'));
    }
     public function StoreUserPaymentHistory(AddUserMoneyToWalletRequest $request,User $user)
    {
// dd($request);

        $currency = get_settings(Settings::CURRENCY);

        // $converted_amount_array =  convert_currency_to_usd($user_currency_code, $request->input('amount'));

        // $converted_amount = $converted_amount_array['converted_amount'];
        // $converted_type = $converted_amount_array['converted_type'];
        // $conversion = $converted_type.':'.$request->amount.'-'.$converted_amount;
        $transaction_id = Str::random(6);


            $wallet_model = new UserWallet();
            $wallet_add_history_model = new UserWalletHistory();
            $user_id = $user->id;


        $user_wallet = $wallet_model::firstOrCreate([
            'user_id'=>$user_id]);
        $user_wallet->amount_added += $request->amount;
        $user_wallet->amount_balance += $request->amount;
        $user_wallet->save();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'card_id'=>null,
            'amount'=>$request->amount,
            'transaction_id'=>$transaction_id,
            'merchant'=>null,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET_FROM_ADMIN,
            'is_credit'=>true]);


         $message = "money_added_successfully";
        return redirect()->back()->with('success', $message);


    }

    public function importUser(){

        $page = trans('pages_names.users');

        $main_menu = 'drivers_and_users';
        $sub_menu = 'user_details';
        $sub_menu_1 = '';


        Excel::import(new UsersImport, request()->file('file'));

             $message = trans('succes_messages.user_import_succesfully');

        return redirect('users')->with('success', $message);

    }

     public function downloadFile()
    {
        $sampleFile = public_path()."/assets/sample_file/sample_file.csv";

        $headers = array(
         'Content-Type : application/csv',
        );


        return response()->download($sampleFile);
    }
    public function UserCancelRequestIndex(User $user)
    {

        $results = $user->userCancellationFee()->paginate();
        // dd($results);

        $page = trans('pages_names.assign_types');

        $main_menu = 'drivers_and_users';
        $sub_menu = 'users';
        $sub_menu_1 = '';

        return view('admin.users.cancellation', compact('results', 'page', 'main_menu', 'sub_menu', 'user','sub_menu_1'));

    }    
}
