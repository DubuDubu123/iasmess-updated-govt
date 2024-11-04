<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\PartyBooking;
use App\Models\Tariff;
use Illuminate\Http\Request;
use App\Models\Admin\VehicleType;
use App\Models\Admin\ServiceLocation;
use App\Http\Controllers\ApiController;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest;
use App\Http\Requests\Admin\VehicleTypes\UpdateVehicleTypeRequest;
use App\Base\Constants\Auth\Role;
use App\Models\Invoice;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use App\Base\Libraries\SMS\SMSContract;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\MobileOtp;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use Illuminate\Support\Facades\DB;

/**
 * @resource Vechicle-Types
 *
 * vechicle types Apis
 */
class PartyController extends BaseController
{
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
    protected $user;

    protected $smsContract;

    protected $imageUploader;

     
    public function __construct(User $user, OTPHandlerContract $otpHandler, SMSContract $smsContract,ImageUploaderContract $imageUploader)
    {
        $this->user = $user;
        $this->otpHandler = $otpHandler; 
        $this->smsContract = $smsContract;
        $this->imageUploader = $imageUploader; 
    }

    /**
    * Get all vehicle types
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        // dd(request()->url());
        $page = trans('pages_names.types');
        $main_menu = 'master';
        $sub_menu = 'party';
        $sub_menu_1 = '';
        $user = $this->user->belongsTorole(Role::USER)->get(); 
        return view('admin.party.index', compact('page', 'main_menu', 'sub_menu','sub_menu_1','user'))->render();
    }

    
    public function view(Request $request,QueryFilterContract $queryFilter,PartyBooking $booking)
    {  
        $page = trans('pages_names.types');
        $main_menu = 'master';
        $sub_menu = 'party';
        $sub_menu_1 = ''; 
        $checkinDate = Carbon::parse($booking->checkin_date); 
        // Get the current date
        $currentDate = Carbon::now('Asia/kolkata'); 
        // Calculate the difference in days between the current date and the check-in date
        $date_diff = $currentDate->diffInDays($checkinDate);
        //   $date_diff = $checkinDate->day - $currentDate->day;
        //  echo $date_diff;
        //  exit;
        return view('admin.party.view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','booking','date_diff'))->render();
    }

     /**
    * Edit Vehicle type view
    *
    */
    public function edit(PartyBooking $booking)
    {   
        // dd($booking);
        $page = trans('pages_names.edit_type'); 
        // dd($type->is_taxi);
        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        // $services = ServiceLocation::whereActive(true)->get();
        $main_menu = 'master';
        $sub_menu = 'party';
        $sub_menu_1 = '';
        $user = $this->user->belongsTorole(Role::USER)->get(); 
        return view('admin.party.update', compact('page','main_menu', 'sub_menu','sub_menu_1','user','booking'));
    }
    public function check_availability(Request $request)
    { 
        // dd(request()->all());
        $currentDate = Carbon::now()->toDateString(); 
      
            $user_id = auth()->user()->id;
            if(isset($request->user))
            { 
                $user_id = $request->user;
            }  
            if(isset($request->id))
            {
                // dd("testt");
                $isBooked =PartyBooking::whereDate('checkin_date', $request->from_date)
                ->whereIn('status',[0,1])
                ->where('id', '!=',$request->id)
                ->exists(); 
            }
            else{
                $isBooked =PartyBooking::whereDate('checkin_date', $request->from_date)->whereIn('status',[0,1])->exists();  
            }
        // dd($isBooked);
        if ($isBooked) {
            $response = [
                "status" => false,
                "message" => "No Party Hall is Available"
            ];
            return response()->json($response);
            // The current date is booked
            // Handle the booked scenario
        } else {
            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();
            $user_id = auth()->user()->id;
            if(isset($request->user))
            { 
                $user_id = $request->user;
            }
            // Retrieve the count of bookings for the current month
             if(isset($request->id))
            {
                $bookingCount = PartyBooking::whereBetween('checkin_date', [$currentMonthStart, $currentMonthEnd])->where('id', '!=',$request->id)->where('user_id',$user_id)->count();
            }
            
            else{
                $bookingCount = PartyBooking::whereBetween('checkin_date', [$currentMonthStart, $currentMonthEnd])->where('user_id',$user_id)->count();
                
            }
            
            // dd($bookingCount);
                if($bookingCount >= 10)
                {
                    $response = [
                        "status" => false,
                        "message" => "Maximum Limit reached for the month"
                    ];
                    return response()->json($response);
                }
                else{
                    $response = [
                        "status" => true,
                        "message" => "Party Hall is Available"
                    ];
                    return response()->json($response);
                } 
        }
    }
   public function book_now(Request $request)
{
    // Check if the request has an id, either update an existing booking or create a new one
    if (isset($request->id)) {
        $bookings = PartyBooking::find($request->id); 
    } else {
        $bookings = new PartyBooking(); 
    }
    
    $bookings->booking_id = time();
    $bookings->checkin_date = $request->from_date;  
    $bookings->guest_type = $request->guest_type;

    $currentMonthStart = Carbon::parse($request->from_date)->startOfMonth();
    $currentMonthEnd = Carbon::parse($request->from_date)->endOfMonth();
    $user_id = auth()->user()->id;
    
     if (isset($request->user)) { 
        // dd("sfsdfsdf");
        $user_id = $request->user;
    } 
    
    if (isset($request->id)) { 
        // dd("sfsdfsdf");
        $user_id = $bookings->user_id;
    }
    // dd($user_id);
    // Retrieve the count of bookings for the current month
    $bookingCount = PartyBooking::whereBetween('checkin_date', [$currentMonthStart, $currentMonthEnd])
        ->where('user_id', $user_id)
        ->count();
    
    $starting_count = $bookingCount; 
    if (isset($request->id)) {
        $end_count = $bookingCount; 
    } else {
        $end_count = $bookingCount + 1; 
    }
    
    // Query the partyhall_tariff table directly
    if ($end_count <= 5) {
        if ($end_count == 0) {
            $end_count = 1;
        }
        $tariff = DB::table('partyhall_tariff')->where('day', $end_count)->first();
    } else {
        $tariff = DB::table('partyhall_tariff')->where('day', 6)->first();
    }

    if (!$tariff) {
        return response()->json([
            "status" => false,
            "message" => "Tariff not found for the selected day"
        ]);
    }

    $price = $tariff->price;
    $total_price = $price;

    $bookings->party_amount = $price;
    $bookings->is_lawn = 0;
    $bookings->lawn_amount = 0; 

    if ($request->has('is_lawn')) {
        $bookings->is_lawn = 1;
        $bookings->lawn_amount = 1000;
        $total_price = $price + 1000;
    }
    // dd($user_id);
    $bookings->tariff = $total_price;
    $bookings->user_id = $user_id;
    $bookings->booked_by = auth()->user()->id;
    $bookings->save();

    // Fetch the user's mobile number from the users table
    $user = DB::table('users')->where('id', $user_id)->first();
    $phoneNumber = $user->mobile;  // Assuming the mobile number column is named 'mobile_number'

    // Prepare the SMS message
    $message = "IAS Officers' Mess: Dear {$user->name}, We are delighted to confirm your Party Lawn/Party Hall booking with us. Below are the details of your reservation - Public Department";
    $apiId = 1007247084047833584;

    // Send SMS
    $smsResponse = $this->smsContract->send1($phoneNumber, $message, $apiId);
    $name = $user->name;
    
      $message1="IAS+Officers%27+Mess%3A+Dear+".urlencode($name)."%2C+We+are+delighted+to+confirm+your+Party+Lawn%2FParty+Hall+booking+with+us.+Below+are+the+details+of+your+reservation+-+Public+Department";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
//     echo $message1;
// dd($response);

    // Prepare the response message
    $response = [
        "status" => true,
        "message" => "Booking Confirmed Successfully and SMS sent.",
        "sms_response" => $smsResponse, // Include the SMS response
    ];

    return response()->json($response);
}



    
    
    
    
// public function getAllTypes(QueryFilterContract $queryFilter)
// {
//     // Retrieve search keyword from the request (if any)
//     $search = request()->input('search', '');

//     // Define the base query with no additional filters, just showing all data
//     $query = PartyBooking::query();

//     // Apply search filter to the query for booking_id if provided
//     if (!empty($search)) {
//         $query->where('booking_id', 'like', "%{$search}%");
//     }

//     // Paginate the results
//     $results = $query->paginate(10); // Limit pagination to 10 per page

//     // Pass the data to the view
//     return view('admin.party._types', compact('results'))->render();
// }
public function getAllTypes(QueryFilterContract $queryFilter)
    {
        $query = PartyBooking::where('booked_by',auth()->user()->id)->orderBy('created_at','desc');
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
        return view('admin.party._types', compact('results'))->render();
    }




    /**
    * Get Types by admin for ajax
    *
    */
    public function byAdmin(Request $request)
    {
        $types = VehicleType::where('admin_id', $request->admin_id)->get();

        return $this->respondSuccess($types);
    }

    /**
    * Create Vehicle type
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_type');
        // $services = ServiceLocation::whereActive(true)->get();
        $main_menu = 'master';
        $sub_menu = 'party';
        $sub_menu_1 = '';
        return view('admin.party.create', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }


    /**
     * Store Vehicle type.
     *
     * @param \App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function store(CreateVehicleTypeRequest $request)
    {
    if (auth()->user()->hasRole(!(Role::ADMIN))) {

         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('party')->with('warning', $message);
        }
    }
        // dd($request->transport_type);
        $created_params = $request->only(['name', 'capacity','is_accept_share_ride','description','supported_vehicles','short_description', 'transport_type','icon_types_for']);

        if ($uploadedFile = $this->getValidatedUpload('icon', $request)) {
            $created_params['icon'] = $this->imageUploader->file($uploadedFile)
                ->saveVehicleTypeImage();
        }
        $created_params['active'] = true;
        $created_params['created_by'] = auth()->user()->id;


        $created_params['is_taxi'] = $request->transport_type;


        $this->vehicle_type->create($created_params);

        $message = trans('succes_messages.type_added_succesfully');

        return redirect('party')->with('success', $message);
    }

    

    /**
     * Update Vehicle type.
     *
     * @param \App\Http\Requests\Admin\VehicleTypes\CreateVehicleTypeRequest $request
     * @param App\Models\Admin\VehicleType $vehicle_type
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */
    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicle_type)
    {
    if (auth()->user()->hasRole(!(Role::ADMIN))) {

        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('party')->with('warning', $message);
        }
    }
        // dd($request->all());
        $this->validateAdmin();
        $created_params = $request->only(['name', 'capacity','is_accept_share_ride','description','supported_vehicles','short_description','transport_type','icon_types_for']);

        if ($uploadedFile = $this->getValidatedUpload('icon', $request)) {
            $created_params['icon'] = $this->imageUploader->file($uploadedFile)
                ->saveVehicleTypeImage();
        }

        $created_params['is_taxi'] = $request->transport_type;
       
        $created_params['updated_by'] = auth()->user()->id;

        $vehicle_type->update($created_params);

        $message = trans('succes_messages.type_updated_succesfully');
        // clear the cache
        cache()->tags('vehilce_types')->flush();
        return redirect('party')->with('success', $message);
    }
    public function toggleStatus(VehicleType $vehicle_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('party')->with('warning', $message);
        }
        
        $status = $vehicle_type->active == 1 ? 0 : 1;
        $vehicle_type->update([
            'active' => $status
        ]);

        $message = trans('succes_messages.type_status_changed_succesfully');
        return redirect('party')->with('success', $message);
    }
    /**
     * Delete Vehicle type.
     *
     * @param App\Models\Admin\VehicleType $vehicle_type
     * @return \Illuminate\Http\JsonResponse
     * @response
     * {
     *"success": true,
     *"message": "success"
     *}
     */

    public function delete(VehicleType $vehicle_type)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect('party')->with('warning', $message);
        }

        $vehicle_type->delete();

        $message = trans('succes_messages.vehicle_type_deleted_succesfully');
        return $message;
    }

public function cancel_booking(PartyBooking $booking)
{
    // Find and update the booking
    $booking = PartyBooking::find($booking->id);
    $booking->status = 2;
    $booking->cancelled_by = auth()->user()->id;
    $user_name = $booking->user->name;
    // Set the current date and time
    $timezone = 'Asia/Kolkata';
    $currentDateTime = Carbon::now($timezone);
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    $booking->cancelled_on = $formattedDateTime;
    $booking->save();

    // Prepare the SMS message
    $phoneNumber = $booking->user->mobile; // Replace with actual phone number
    $bookingId = $booking->booking_id; // Use booking ID or any other relevant data
    $message = "IAS Officers' Mess: Dear ".$user_name.", With reference to your Party Lawn/Party Hall Booking ID $bookingId, we regret to inform you that your booking has been cancelled as per your request. A refund for the cancelled booking has been initiated.";
    $apiId = 1007804631229240779; // Use the new API ID
  $message1="IAS+Officers%27+Mess%3A+Dear+".urlencode($user_name)."%2C+With+reference+to+your+Party+Lawn%2FParty+Hall+Booking+ID+".$bookingId."%2C+we+regret+to+inform+you+that+your+booking+has+been+cancelled+as+per+your+request.+A+refund+for+the+cancelled+booking+has+been+initiated.";
//   echo $message1;
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
    // dd($response);
    // Send the SMS and capture the response
    try {
        $smsResponse = $this->smsContract->send1($phoneNumber, $message, $apiId);
    } catch (\Exception $e) {
        // Handle the exception or return an error response
        return response()->json([
            "status" => false,
            "message" => "Error sending SMS: " . $e->getMessage(),
        ]);
    }

    // Return the SMS response and booking cancellation response
    return response()->json([
        "status" => true,
        "message" => "Booking Cancelled Successfully and SMS sent.",
        "sms_response" => $smsResponse, // Include the SMS response
    ]);
}

public function availability_view()
{ 
    $page = trans('pages_names.types');
    $main_menu = 'party-view';
    $sub_menu = '';
    $sub_menu_1 = '';
    $user = $this->user->belongsTorole(Role::USER)->get(); 
    return view('admin.party.availability_view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','user'))->render(); 
}
public function availability_view_fetch(QueryFilterContract $queryFilter,Request $request)
{ 
    $start_ite = 0;
    $end_ite = 9;
    if($request->date_value)
    {
        $date_value = $request->date_value;
        switch ($date_value) {
            case 1:
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('from_date'))->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->input('to_date'))->endOfDay(); 
                $end_ite = 0;
                break;
            case 2:
                
                $fromDate = Carbon::today('Asia/Kolkata')->startOfDay();
                $toDate = Carbon::today('Asia/Kolkata')->endOfDay(); 
                $end_ite = 0;
                break;
            case 3:
                $fromDate = Carbon::now('Asia/Kolkata')->startOfWeek();
                $toDate = Carbon::now('Asia/Kolkata')->endOfWeek();  
                $end_ite = 6;
                break;
            case 4:
                $fromDate = Carbon::now('Asia/Kolkata')->startOfMonth();
                $toDate = Carbon::now('Asia/Kolkata')->endOfMonth(); 
                break;
            case 5:
                $fromDate = Carbon::now('Asia/Kolkata')->startOfYear();
                $toDate = Carbon::now('Asia/Kolkata')->endOfYear();  
                break;
        
        }
        if(isset($request->type) && $request->type > 1)
        {
            $type = $request->type;
            $next_page = ($request->type - 1) * 10;
            $now = Carbon::now('Asia/Kolkata')->addDays($next_page); // Format the current date as Y-m-d
            $currentDate = $now->format('Y-m-d H:i:s'); 
        }
        else{
            $type = 1;
            $now = Carbon::now('Asia/Kolkata');
            $currentDate = $now->format('Y-m-d');
        } 
    } 
    else{
        if(isset($request->type) && $request->type > 1)
        {
            $type = $request->type;
            $next_page = ($request->type - 1) * 10;
            $now = Carbon::now('Asia/Kolkata')->addDays($next_page); // Format the current date as Y-m-d
            $currentDate = $now->format('Y-m-d H:i:s'); 
        }
        else{
            $type = 1;
            $now = Carbon::now('Asia/Kolkata');
            $currentDate = $now->format('Y-m-d');
        } 
    }
    
    $nextnine_days = $now->copy()->addDays(9)->format('Y-m-d H:i:s');  
    // $tariff = Tariff::get();
    // $room_count = $tariff[0]->total_rooms;
    $room_count = 1;
    $data_content = ' <div class="box-body no-padding"><div class="table-responsive"><table class="table table-hover"><thead><tr><th>Date</th>';
    for($i=1;$i<=$room_count;$i++)
    {
        $data_content.=' <th>Room '.$i.'</th>';
    }
    $data_content.= '</thead><tbody>';


    for($i=0;$i<=9;$i++)
    { 
        $nextDay = $now->copy()->addDays($i)->format('Y-m-d'); 
        $total_booking_count = PartyBooking::where(function($query) use ($nextDay) {
            $query->whereDate('checkin_date', '=', $nextDay);
        })
        ->whereIn('status', [0, 1])  
        ->count();  
       
        $date_format = $now->copy()->addDays($i)->format('d-M-Y');
        $tr_content = '<tr>';
        $tr_content.='<td style=" background-color: #86bebd;color: white;"> '.$date_format.'</td>';
        for($k=1;$k<=$room_count;$k++)
        { 
            if($total_booking_count != null && $total_booking_count > 0)
            {
                // echo $nextDay."----";
                // echo $total_booking_count;
                // if($k <= $total_booking_count)
                if($total_booking_count == 1)
                { 
                    $tr_content.='<td style=" background-color: red;color: white;"> Reserved</td>';
                }
                else{  
                    $tr_content.='<td style="background-color: green;color: white; "> Available</td>';
                }
            }
            else{  
                $tr_content.='<td style="background-color: green;color: white; "> Available</td>';
            } 
        }
        $tr_content.="</tr>"; 
        $data_content.=$tr_content;
    } 



    $data_content.='</tbody></table><div class="text-right"><span style="float:right"><nav><ul class="pagination">';
    // dd($data_content);
    $nextnine_days = $now->copy()->addDays(9)->format('Y-m-d');
    $endOfYear = $now->copy()->addYear()->format('Y-m-d');
    $daysDifference = $now->diffInDays($endOfYear); 
    $count = ceil($daysDifference / 10); 
    // Pagination logics
    $current_page = $type;
    $first_page = 1;
    $last_page = $count;
    $total_pagination_length = 11;
    $double_date_possiblity =  ceil($total_pagination_length / 2) + 1; 
    $front_dot_validity = $double_date_possiblity;
    $back_dot_validity = $last_page - $double_date_possiblity; 
    $center_view = 7;
            
    // Previous button
    if ($current_page == $first_page) {
        $data_content .= '<li class="page-item disabled"><span class="page-link" aria-hidden="true">&lsaquo;</span></li>';
    } else {
        $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type='.($type-1).'">&rsaquo;</a></li>';
    }
    $min = 1;
    // Front dots
    if ($type > $first_page + 5) { // Adjusted to +2 for showing two pages before dots
        $min = $type - 2;
        $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch">1</a></li>';
        $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type=2">2</a></li>'; // Added the second page
        $data_content .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }  
    $content = "";
    // Back dots
    if ($type < $last_page - 5) { // Adjusted to -2 for showing two pages after dots
        if ($type > $first_page + 5) {
            $max = $type + 2;
        }
        else{
            $max = $first_page + $center_view;
        } 
        $content .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        $content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type='. ($last_page - 1) .'">' . ($last_page - 1) . '</a></li>'; // Added the second to last page
        $content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type='.$last_page.'">'.$last_page.'</a></li>';
    } else{
        $min = $last_page - $center_view; 
        $max =  $last_page; 
    } 
    for ($i = $min; $i <= $max; $i++) {
        if ($i == $type) {
            $data_content .= '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
        } else {
            $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type='.$i.'">'.$i.'</a></li>';
        }
    } 
    $data_content .=$content; 
    // Next button
    if ($type == $last_page) {
        $data_content .= '<li class="page-item disabled"><span class="page-link" aria-hidden="true">&rsaquo;</span></li>';
    } else {
        $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/party/availability-view/fetch?type='.($type+1).'">&rsaquo;</a></li>';
    } 
    $data_content.='</ul></nav></span></div></div></div>';   
    // dd($results->links());
    return view('admin.party.availability_view_types', compact('data_content'))->render(); 
}


}
