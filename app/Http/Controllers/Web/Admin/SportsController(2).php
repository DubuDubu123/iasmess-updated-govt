<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SportsBooking;
use App\Models\SportsTariff;
use App\Models\SportsTariffBooking; 
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
use App\Base\Libraries\SMS\SMSContract;
use App\Helpers\Exception\ExceptionHelpers;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use DB;
/**
 * @resource Vechicle-Types
 *
 * vechicle types Apis
 */
class SportsController extends BaseController
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
        $sub_menu = 'sports';
        $sub_menu_1 = '';
        $sports_tariff = SportsTariff::get();
        $user = $this->user->belongsTorole(Role::USER)->get(); 
        return view('admin.sports.index', compact('page', 'main_menu', 'sub_menu','sub_menu_1','sports_tariff','user'))->render();
    }
    public function view(Request $request,QueryFilterContract $queryFilter,SportsBooking $booking)
    { 
         
        $page = trans('pages_names.types');
        $main_menu = 'master';
        $sub_menu = 'sports';
        $sub_menu_1 = ''; 
        $checkinDate = Carbon::parse($booking->checkin_date); 
        // Get the current date
        $currentDate = Carbon::now('Asia/kolkata'); 
        // Calculate the difference in days between the current date and the check-in date
        $daysDifference = $currentDate->diffInDays($checkinDate);
       $date_diff = $checkinDate->day - $currentDate->day;
    //    dd($date_diff);
    //    dd($booking->details[0]->tariff); 
        return view('admin.sports.view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','booking','date_diff'))->render();
    }

  public function book_now(Request $request)
{
    // Fetch user ID
    $user_id = auth()->user()->id;
    if (isset($request->user)) {
        $user_id = $request->user;
    }

    // Set the check-in and check-out dates
    $checkinDatetime = Carbon::createFromFormat('Y-m-d', $request->from_date, 'Asia/Kolkata')->startOfDay()->format('Y-m-d H:i:s');
    $checkoutDatetime = Carbon::createFromFormat('Y-m-d', $request->to_date, 'Asia/Kolkata')->endOfDay()->format('Y-m-d H:i:s');

    // Create a new booking entry
    $bookings = new SportsBooking();
    $bookings->booking_id = time();
    $bookings->checkin_date = $checkinDatetime;
    $bookings->checkout_date = $checkoutDatetime;
    $bookings->subscription_type = $request->subscription_type;
    $bookings->tariff = $request->total_amount;
    $bookings->user_id = $user_id;
    $bookings->booked_by = auth()->user()->id;
    $bookings->save();

    // Loop through tariff selections
    foreach ($request->name as $key => $value) {
        $sports_tariff_booking = new SportsTariffBooking();
        $sports_tariff_booking->booking_id = $bookings->id;
        $sports_tariff_booking->tariff_id = $value;
        
        // Fetch the tariff
        $tariff = SportsTariff::find($value);
        
        // Ensure that tariff exists
        if (!$tariff) {
            return response()->json([
                'status' => false,
                'message' => "Tariff ID {$value} not found."
            ], 404);
        }

        // Assign the price based on the subscription type
        if ($request->subscription_type == "daily") {
            $sports_tariff_booking->price = $tariff->daily_tariff;
        } elseif ($request->subscription_type == "monthly") {
            $sports_tariff_booking->price = $tariff->mothly_tariff;  // Check correct spelling: "monthly_tariff"
        } else {
            $sports_tariff_booking->price = $tariff->yearly_tariff;
        }

        // Check if price is null (invalid tariff)
        if (is_null($sports_tariff_booking->price)) {
            return response()->json([
                'status' => false,
                'message' => "Price for tariff ID {$value} is not available."
            ], 400);
        }

        // Save the tariff booking
        $sports_tariff_booking->save();
    }

        // Fetch the user's mobile number
    $user = DB::table('users')->where('id', $user_id)->first();
    $phoneNumber = $user->mobile;

    // Prepare the SMS message
    $subscriptionType = ucfirst($request->subscription_type);
    $endDate = Carbon::parse($checkoutDatetime)->format('d/m/Y');
    
    $message = "IAS Officers' Mess: Dear {$user->name},\r\nCongratulations! You have successfully taken the subscription of [{$subscriptionType}] at IAS Officers' Mess. The duration of your subscription upto {$endDate} - TNPROT";
    $apiId = 1007612386233481651;

    // Send the SMS
    $data = $this->smsContract->send1($phoneNumber, $message, $apiId);
    
      $message1="IAS+Officers%27+Mess%3A+Dear+".urlencode($user->name)."+%2C%5CnCongratulations%21+You+have+successfully+taken+the+subscription+of+%5B".urlencode($subscriptionType)."%5D+at+IAS+Officers%27+Mess.+The+duration+of+your+subscription+upto+".$endDate."+-+TNPROT";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile

    $response = [
        "status" => true,
        "message" => "Booking Confirmed Successfully and SMS sent.",
        "sms_response" => $data // Include the SMS response
    ];

    return response()->json($response);
}


    

    public function getAllTypes(QueryFilterContract $queryFilter)
    {
        // dd(auth()->user()->hasRole('mess-manager'));
        if(auth()->user()->hasRole('super-user') || auth()->user()->hasRole('mess-manager'))
        {
            $query = SportsBooking::orderBy('created_at','desc');
        }
        else{
            $query = SportsBooking::where('user_id',auth()->user()->id)->orderBy('created_at','desc');
        }
       
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
        return view('admin.sports._types', compact('results'))->render();
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
        $sub_menu = 'sports';
        $sub_menu_1 = '';
        return view('admin.sports.create', compact('page', 'main_menu', 'sub_menu','sub_menu_1'));
    }

 
    /**
    * Edit Vehicle type view
    *
    */
    public function edit($id)
    {   
        $page = trans('pages_names.edit_type');
        $type = $this->vehicle_type->where('id', $id)->first();
        // dd($type->is_taxi);
        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        // $services = ServiceLocation::whereActive(true)->get();
        $main_menu = 'master';
        $sub_menu = 'sports';
        $sub_menu_1 = '';
        return view('admin.sports.update', compact('page', 'type', 'main_menu', 'sub_menu','sub_menu_1'));
    }
 
    public function cancel_booking(SportsBooking $booking)
    {
         $booking = SportsBooking::find($booking->id);
         $booking->status = 2; 
         $booking->cancelled_by = auth()->user()->id;
         $timezone = 'Asia/Kolkata'; 
         // Get the current date and time in the specified timezone
         $currentDateTime = Carbon::now($timezone); 
         $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
         $booking->cancelled_on = $formattedDateTime;
         $booking->save();
         $message = [
            "status" => true,
            "message" => "Booking Cancelled Successfully",
         ];
         return response()->json($message);
    }
    public function confirm_booking(SportsBooking $booking)
    {
         $booking = SportsBooking::find($booking->id); 
         $booking->is_paid =  1;  
         $booking->status =  3;  
         $booking->save();
         $invoice = new Invoice();
         $invoice_number = Invoice::orderBy('created_at', 'DESC')->pluck('invoice_number')->first();
         if ($invoice_number) {
            // Extract the numeric part from the userid
            preg_match('/(\d+)$/', $invoice_number, $matches);
            $numberPart = isset($matches[1]) ? intval($matches[1]) + 1 : 500001; // Increment or default to 1001 if not found
            $invoice_number = str_pad($numberPart, 6, '0', STR_PAD_LEFT); // Ensure the number part is at least 4 digits
        } else {
            $invoice_number = "500001"; // Default userid
        } 
        $invoice->invoice_number =  $invoice_number;
        $invoice->booking_id =  $booking->id;
        $invoice->customer_id =  $booking->user_id;
        $now = Carbon::now('Asia/Kolkata');
        $invoice->issue_date =  $now->format("Y-m-d");
        $invoice->due_date =  $booking->checkin_date;
        $invoice->total_amount =  $booking->tariff; 
        $invoice->type =  2;
        $invoice->status =  1;
        $invoice->save(); 
         $message = [
            "status" => true,
            "message" => "Payment Done Successfully",
         ];
         return response()->json($message);
    }
    /**
    * Get Types by admin for ajax
    *cancel_booking
    */
    public function view_invoice(Request $request,QueryFilterContract $queryFilter,SportsBooking $booking)
    { 
        $page = trans('pages_names.types');
        $main_menu = 'master';
        $sub_menu = 'types';
        $sub_menu_1 = '';
        $query = SportsBooking::where('booked_by',auth()->user()->id); 
        $invoice = Invoice::where('booking_id',$booking->id)->first(); 
        $checkinDate = Carbon::parse($booking->checkin_date);

        // Get the current date
        $currentDate = Carbon::now('Asia/kolkata');

        // Calculate the difference in days between the current date and the check-in date
        $daysDifference = $currentDate->diffInDays($checkinDate);
       $date_diff = $checkinDate->day - $currentDate->day;
        
        // dd($daysDifference);
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
        // dd($results->)
        // dd($booking->booked_price);
        return view('admin.sports_booking.invoice', compact('page', 'main_menu', 'sub_menu','sub_menu_1','booking','date_diff','invoice'))->render();
    }
}
