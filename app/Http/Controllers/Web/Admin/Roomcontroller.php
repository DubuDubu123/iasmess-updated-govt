<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RoomBooking;
use App\Models\PartyBooking;
use App\Models\SportsBooking;
use App\Models\RoomBookingPrice;
use App\Models\RoomBookingGuest;
use App\Models\Tariff;
use App\Models\Invoice;
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
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Collection; 
use PDF;
use DB;
use App\Base\Libraries\SMS\SMSContract;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\MobileOtp;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use App\Jobs\Notifications\Auth\Registration\UserNotification;
use Illuminate\Support\Str;
use Mail;
use App\Jobs\SendWhatsAppReminder;
    /**
     * @resource Vechicle-Types
     *
     * vechicle types Apis
     */
    class Roomcontroller extends BaseController
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
    
    
    public function send_payment_link($booking,Request $request) 
    { 
        // Generate a unique token for the payment link
        $token = Str::random(32);
        RoomBooking::where('id',$booking)->update(['payment_link' => $token,'advance_amount'=>$request->price]);  
        $booking_price= RoomBookingPrice::where('booking_id',$booking)->first(); 
        $booking_price->initial_price = 0;
        $booking_price->initial_price_status = 0;
            // dd($request->price);
        if ($request->amount) { 
            $booking_price->initial_price = $request->price ?? 0;
            $booking_price->initial_price_status = 1; 
            $booking_price->amount_need_to_paid = $booking_price->total_price - $request->price;  
        } 
        $booking_price->save();
        $booking_data = RoomBooking::where('id',$booking)->first();
        $user = User::find($booking_data->user_id); 
            // Prepare the email details
            $details = [
               'title' => "Payment Link for Your IAS Mess Booking – [Booking ID: ".$booking_data->booking_id."]",
                'booking_details' => $booking_data,
                'user_details' => $user,
                'booking_type' => 'Room Booking',
                 'booking_types' => 'room-booking', 
                'type' => 'send_payment_link1'
            ];
        
            // Send the email with the payment link
            Mail::to($user->email)->send(new UserNotification($details));
        
            // Prepare the SMS message
            // $message = "IAS Officers' Mess: Dear {$user->name}, We are pleased to inform you that your membership form, with reference to registration ID {$user->userid}, has been verified successfully. To complete the process, please pay your membership fees. The payment link is provided in the email sent to you.";
            // $apiId = 1007345074381075779;
        
            // Send the SMS
            $phoneNumber = $user->mobile; // Assuming 'mobile' is the column name for phone number
            //dd($phoneNumber);
            // $this->smsContract->send1($phoneNumber, $message, $apiId);
            
            //  $message1="IAS+Officers%27+Mess%3A+Dear+".$user->name."%2C+We+are+pleased+to+inform+you+that+your+membership+form%2C+with+reference+to+registration+ID+".$user->userid."+has+been+verified+successfully.+To+complete+the+process%2C+please+pay+your+membership+fees.+The+payment+link+is+provided+in+the+email+sent+to+you."; 
            // $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
            // dd($response);
            // Prepare the response 
            $response = [
                'status' => true,
                'message' => 'Approved and SMS sent.'
            ];
        
            return response()->json($response); 
    } 
    
    
      public function send_payment_link_checkout($booking,Request $request) 
    { 
        // Generate a unique token for the payment link
        $token = Str::random(32);
        RoomBooking::where('id',$booking)->update(['payment_link' => $token]);  
        $booking_price= RoomBookingPrice::where('booking_id',$booking)->first();   
        $booking_data = RoomBooking::where('id',$booking)->first();
        $user = User::find($booking_data->user_id); 
            // Prepare the email details
            $details = [
                'title' => "Mail from IAS Officers' App",
                'booking_details' => $booking_data,
                'user_details' => $user,
                'booking_type' => 'Room',
                'booking_types' => 'room-booking', 
                'type' => 'send_payment_link1'
            ];
        
            // Send the email with the payment link
            Mail::to($user->email)->send(new UserNotification($details));
        
            // Prepare the SMS message
            // $message = "IAS Officers' Mess: Dear {$user->name}, We are pleased to inform you that your membership form, with reference to registration ID {$user->userid}, has been verified successfully. To complete the process, please pay your membership fees. The payment link is provided in the email sent to you.";
            // $apiId = 1007345074381075779;
        
            // Send the SMS
            $phoneNumber = $user->mobile; // Assuming 'mobile' is the column name for phone number
            //dd($phoneNumber);
            // $this->smsContract->send1($phoneNumber, $message, $apiId);
            
            //  $message1="IAS+Officers%27+Mess%3A+Dear+".$user->name."%2C+We+are+pleased+to+inform+you+that+your+membership+form%2C+with+reference+to+registration+ID+".$user->userid."+has+been+verified+successfully.+To+complete+the+process%2C+please+pay+your+membership+fees.+The+payment+link+is+provided+in+the+email+sent+to+you."; 
            // $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
            // dd($response);
            // Prepare the response 
            $response = [
                'status' => true,
                'message' => 'Approved and SMS sent.'
            ];
        
            return response()->json($response); 
    } 
        /**
        * Get all vehicle types
        * @return \Illuminate\Http\JsonResponse
        */
public function index()
{
    $page = trans('pages_names.types');
    $main_menu = 'master';
    $sub_menu = 'types';
    $sub_menu_1 = '';

    // Fetch users excluding those with is_deleted = 1
    $user = $this->user->belongsTorole(Role::USER)->where('is_deleted', '!=', 1)->get();
    
    // Check if the current user is deleted
    $currentUser = auth()->user();
    $isDeleted = $currentUser->is_deleted;

    $room_tariff = Tariff::get();
    $room_count = $room_tariff[0]->total_rooms;

    return view('admin.types.index', compact('page', 'main_menu', 'sub_menu', 'sub_menu_1', 'user', 'isDeleted','room_count'))->render();
}



public function getAllTypes(QueryFilterContract $queryFilter)
{
    // Retrieve search keyword from the request
    $search = request()->input('search', '');

    if (auth()->user()->hasRole('super-user') || auth()->user()->hasRole('mess-manager')) {
        // Join users table only once with an alias if needed
        $query = RoomBooking::query()
                            ->join('users as u', 'room_booking.user_id', '=', 'u.id') // Alias for users table
                            ->select('room_booking.*', 'u.name as user_name', 'u.email', 'u.mobile');
    } else {
        $query = RoomBooking::where('room_booking.user_id', auth()->user()->id)
                            ->join('users as u', 'room_booking.user_id', '=', 'u.id') // Alias for users table
                            ->select('room_booking.*', 'u.name as user_name', 'u.email', 'u.mobile');
    }

    // Apply search filter to the query
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('room_booking.booking_id', 'like', "%{$search}%")
              ->orWhere('u.name', 'like', "%{$search}%")
              ->orWhere('u.email', 'like', "%{$search}%")
              ->orWhere('u.mobile', 'like', "%{$search}%");
        });
    }

    $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

    return view('admin.types._types', compact('results'))->render();
}




        /**
        * Get Types by admin for ajax
        *cancel_booking
        */
        public function view(Request $request,QueryFilterContract $queryFilter,RoomBooking $booking)
        { 
            $page = trans('pages_names.types');
            $main_menu = 'master';
            $sub_menu = 'types';
            $sub_menu_1 = '';
            $query = RoomBooking::where('booked_by',auth()->user()->id); 
            $checkinDate = Carbon::parse($booking->checkin_date);
            $checkout_date = Carbon::parse($booking->checkout_date);

            // Get the current date
            $currentDate = Carbon::now('Asia/kolkata');

            // Calculate the difference in days between the current date and the check-in date
            $daysDifference = $currentDate->diffInDays($checkinDate);
            $date_diff = $checkinDate->day - $currentDate->day;
            $date_diff1 = $checkout_date->day - $currentDate->day;
            
            // dd($daysDifference);
            $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();
            return view('admin.types.view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','booking','date_diff'))->render();
        }
        /**
        * Get Types by admin for ajax
        *
        */
        // public function book_now(Request $request)
        // {
        //     // dd($request->all());
        //     $now = Carbon::now('Asia/Kolkata');
        //     // Get the start and end of the current month
        //     $startOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s'); 
        //     $endOfMonth = $now->endOfMonth(); 
        //     $user_id = auth()->user()->id;
        //     if(isset($request->user))
        //     { 
        //         $user_id = $request->user;
        //     }
        //     // dd($request->user);
        //     // Query to get bookings that overlap with the current month
        //     if(isset($request->id))
        //     {
        //         $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
        //         ->where('user_id',$user_id)
        //         ->whereIn('status',[0,1,3])
        //         ->where('id', '!=',$request->id)
        //         ->get();
                
        //     }
        //     else{
        //         $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
        //         ->where('user_id',$user_id)
        //         ->whereIn('status',[0,1,3])
        //         ->get(); 
        //     }
            
        //     $booking_count = 0;
        //     foreach($totalDaysBooked as $key=>$value)
        //     {
        //         $checkin = Carbon::parse($value->checkin_date);
        //         $checkout = Carbon::parse($value->checkout_date);
        //         $month_differ = $checkout->month - $checkin->month;
        //         if($month_differ > 0)
        //         { 
        //             $day_count = $endOfMonth->day - $checkin->day; 
        //             if($day_count == 0)
        //             {
        //                 $booking_count+=1;
        //             }
        //             else{
        //                 $booking_count+=$day_count;
        //             }
        //         }
        //         else{
        //                 $booking_count+=$value->booking_count;
        //         }
        //     } 
        //     // dd($user_id);
        //     $checkinDatetime = Carbon::createFromFormat('Y-m-d', $request->from_date, 'Asia/Kolkata')->startOfDay()->format('Y-m-d H:i:s');
        //     $checkoutDatetime = Carbon::createFromFormat('Y-m-d', $request->to_date, 'Asia/Kolkata')->endOfDay()->format('Y-m-d H:i:s'); 

        //     $checkinDate = $request->input('from_date'); 
        //     $checkoutDate = $request->input('to_date'); 
        //     // Convert strings to Carbon instances
        //     $checkin = Carbon::createFromFormat('Y-m-d', $checkinDate);
        //     $checkout = Carbon::createFromFormat('Y-m-d', $checkoutDate);

        //     // Calculate the difference in days
        //     $differenceInDays = $checkin->diffInDays($checkout); 
        //     $booking_counts = $differenceInDays * $request->room;
        //     // if($booking_counts > 10)
        //     // {
        //     //     $response = [
        //     //         "status" => false,
        //     //         "message" => "Only you can able to make 10 bookings, Limit is reached"
        //     //     ];
        //     //     return response()->json($response);
        //     // } 
            
        //     if(isset($request->id))
        //     {
        //         $bookings =  RoomBooking::find($request->id); 
        //     }
        //     else{
        //         $bookings =  new RoomBooking(); 
        //     }
        //     // dd($user_id); 
        //     $bookings->booking_id = time();
        //     $bookings->checkin_date = $checkinDatetime;
        //     $bookings->checkout_date = $checkoutDatetime;
        //     $bookings->no_of_rooms = $request->room;
        //     $bookings->no_of_guests = $request->guest;
        //     $bookings->no_of_days = $differenceInDays;
        //     // $bookings->guest_type = $request->guest_type;
        //     $bookings->booking_count = $booking_counts;
        //     $starting_count = $booking_count + 1; 
        //     $end_count = $booking_counts + $booking_count;  
        //     $end_count1 = $differenceInDays + $booking_count;  
        //     $tariff = Tariff::get();
        //     $price = 0; 
        //     $bookings->tariff = $price;
        //     $bookings->user_id = $user_id;
        //     $bookings->booked_by = auth()->user()->id;
        //     if(isset($request->id))
        //     {  
        //         $bookings->modified_by = $user_id;
        //         $timezone = 'Asia/Kolkata'; 
        //         // Get the current date and time in the specified timezone
        //         $currentDateTime = Carbon::now($timezone); 
        //         $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
        //         $bookings->modified_on = $formattedDateTime;
        //     }
        //     if($end_count > 5)
        //     {
        //         $bookings->is_admin_approve = 0;
        //         // if(isset($request->id))
        //         // {  
        //             if(auth()->user()->hasRole("super-user"))
        //             {
        //                 $bookings->is_admin_approve = 1;
        //             }
        //         // }   
        //     }
            
        //     $bookings->save();
            
        //     $room_price_details = new \stdClass();
            
        //     $counts = 0;
        //     $per_day_price = 0;
        //     $per_day_price_guest = 0;
        //     for($i=1;$i<=$differenceInDays;$i++)
        //     {  
        //         for($k=1;$k<=$request->room;$k++)
        //         { 
        //             $room_price_details->pricing_details[$counts] =  new \stdClass();
        //             if($starting_count > 5)
        //             {
        //                 $tariff = Tariff::where('day',6)->first();
        //             }
        //             else{
        //                 $tariff = Tariff::where('day',$starting_count)->first();
        //             }
                    
        //             $room_price_details->pricing_details[$counts]->days_count = $starting_count;
        //             if($request->guest_type[$k] == "guest")
        //             { 
                        
        //                 $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_others;
        //                 $per_day_price+=$tariff->rent_for_others;
        //                 $price+=$tariff->rent_for_others;
        //                 $roombooking_price[$k]['price'] = $per_day_price;
        //                 $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];

        //             }
        //             else{ 
        //                 $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_officers_family;
        //                 $per_day_price_guest+=$tariff->rent_for_officers_family;
        //                 $price+=$tariff->rent_for_officers_family;
        //                 $roombooking_price[$k]['price'] = $per_day_price_guest;
        //                 $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];
        //             } 
        //             $room_price_details->pricing_details[$counts]->guest_type = $request->guest_type[$k];
        //             $starting_count++;
        //             $counts++; 
        //         } 

        //     } 
        
        //     $k = 1;
        //     if(isset($request->id))
        //     {
        //     RoomBookingGuest::where('booking_id',$bookings->id)->delete();
        //     }
        //     // dd($roombooking_price);
        //     foreach($roombooking_price as $key=>$value)
        //     {
        //         // dd($value);
        //         $room_booking_guest = new RoomBookingGuest();  
        //         $room_booking_guest->booking_id = $bookings->id;
        //         $room_booking_guest->room = $k;
        //         $room_booking_guest->per_day_price = $value['price'];
        //         $room_booking_guest->guest_type = $value['guest_type'];
        //         $room_booking_guest->save();
        //         $k++;
        //     }
            
        //     // dd($room_price_details);
        //     // foreach($tariff as $key=>$value)
        //     // {
        //     //     for($i=$starting_count;$i<=$end_count1;$i++)
        //     //     { 
        //     //         if($value->day == $i)
        //     //         {
        //     //             if($request->guest_type == "guest")
        //     //             { 
        //     //                 $price+=$value->rent_for_others;
        //     //             }
        //     //             else{ 
        //     //                 $price+=$value->rent_for_officers_family;
        //     //             }
        //     //         }
        //     //     }
        //     // } 
        //     if(isset($request->id))
        //     {
        //         $booking_price= RoomBookingPrice::where('booking_id',$request->id)->first();
        //     }

        //     else{
        //         $booking_price= new RoomBookingPrice();
        //     }
        
        //     $booking_price->booking_id = $bookings->id;
        //     $booking_price->room_price_details =json_encode($room_price_details); 
        //     $booking_price->total_price = $price;
        //     $booking_price->amount_need_to_paid = $price;
        //     $booking_price->save();
        //     //  dd("gdfgf");
        //     if($end_count > 5)
        //     {  
        //         $response = [
        //                 "status" => true,
        //                 "message" => "Booking confirmation request submitted for Admin approval. Updates will be sent to the registered mobile number and email at the earliest."
        //             ];
        //         if(auth()->user()->hasRole("super-user"))
        //         {
        //             $response = [
        //             "status" => true,
        //             "message" => "Booking Confirmed Successfully"
        //         ];
                
        //         } 
        //     }
        //     else{
        //         $response = [
        //             "status"=> true,
        //             "message" => "Booking Confirmed Successfully"
        //         ]; 
        //     } 
        //     return response()->json($response);

        // }

         /**
        * Get Types by admin for ajax
        *
        */
        public function book_now(Request $request)
        {
            
            
            
            //dd($request->all());
            $now = Carbon::now('Asia/Kolkata');
            // Get the start and end of the current month
            $startOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s'); 
            $endOfMonth = $now->endOfMonth(); 
            $user_id = auth()->user()->id;
            if(isset($request->user))
            { 
                $user_id = $request->user;
            }
            // dd($request->user);
            // Query to get bookings that overlap with the current month
            if(isset($request->id))
            {
                $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
                ->where('user_id',$user_id)
                ->whereIn('status',[0,1,3])
                ->where('id', '!=',$request->id)
                ->get();
                
            }
            else{
                $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
                ->where('user_id',$user_id)
                ->whereIn('status',[0,1,3])
                ->get(); 
            }
            
            $booking_count = 0;
            foreach($totalDaysBooked as $key=>$value)
            {
                $checkin = Carbon::parse($value->checkin_date);
                $checkout = Carbon::parse($value->checkout_date);
                $month_differ = $checkout->month - $checkin->month;
                if($month_differ > 0)
                { 
                    $day_count = $endOfMonth->day - $checkin->day; 
                    if($day_count == 0)
                    {
                        $booking_count+=1;
                    }
                    else{
                        $booking_count+=$day_count;
                    }
                }
                else{
                        $booking_count+=$value->booking_count;
                }
            } 
            // dd($user_id);
            $checkinDatetime = Carbon::createFromFormat('Y-m-d', $request->from_date, 'Asia/Kolkata')->startOfDay()->format('Y-m-d H:i:s');
            $checkoutDatetime = Carbon::createFromFormat('Y-m-d', $request->to_date, 'Asia/Kolkata')->endOfDay()->format('Y-m-d H:i:s'); 

            $checkinDate = $request->input('from_date'); 
            $checkoutDate = $request->input('to_date'); 
            // Convert strings to Carbon instances
            $checkin = Carbon::createFromFormat('Y-m-d', $checkinDate);
            $checkout = Carbon::createFromFormat('Y-m-d', $checkoutDate);

            // Calculate the difference in days
            $differenceInDays = $checkin->diffInDays($checkout); 
            // $booking_counts = $differenceInDays * $request->room;
            $booking_counts = $differenceInDays;
            $total_booked_counts = $booking_counts + $booking_count;
            if(auth()->user()->hasRole('user'))
            {
                if($differenceInDays > 5)
                {
                    $response = [
                        "status" => false,
                        "message" => "Only you can able to book 5 days"
                    ];
                    return response()->json($response);
                } 
                if($total_booked_counts > 5)
                { 
                    $days_diffs = 5 - $booking_count;
                    if($days_diffs > 0)
                    {
                        $response = [
                            "status" => false,
                            "message" => "Month Quota is Exceeded , Only ".$days_diffs." days are available"
                        ];
                    }
                    else{
                        $response = [
                            "status" => false,
                            "message" => "Month Quota is Exceeded"
                        ];
                    }
                  
                    return response()->json($response);
                } 
            }
            
            
            
            if(isset($request->id))
            {
                $bookings =  RoomBooking::find($request->id);  
            }
            else{
                $bookings =  new RoomBooking(); 
            }
            // dd($user_id); 
            $bookings->booking_id = time();
            
            $bookings->checkin_date = $checkinDatetime;
            $bookings->checkout_date = $checkoutDatetime;
            $bookings->no_of_rooms = $request->room;
            $bookings->no_of_guests = $request->guest;
            $bookings->no_of_days = $differenceInDays;
            // $bookings_mobile = $request->mobile;
            // dd($bookings_mobile);
            $bookings->booking_count = $booking_counts;
            $starting_count = $booking_count + 1; 
            $end_count = $booking_counts + $booking_count;  
            $end_count1 = $differenceInDays + $booking_count;  
            $tariff = Tariff::get();
            $price = 0; 
            $bookings->tariff = $price;
            $bookings->user_id = $user_id;
            $bookings->booked_by = auth()->user()->id;
            if(isset($request->id))
            {  
                $bookings->modified_by = $user_id;
                $timezone = 'Asia/Kolkata'; 
                // Get the current date and time in the specified timezone
                $currentDateTime = Carbon::now($timezone); 
                $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
                $bookings->modified_on = $formattedDateTime;
            }
            $bookings->is_admin_approve = 1;
     
            
            $bookings->save();
            
            $room_price_details = new \stdClass();
            
            $counts = 0;
            $per_day_price = 0;
            $per_day_price_guest = 0;
            for($i=1;$i<=$differenceInDays;$i++)
            {  
                for($k=1;$k<=$request->room;$k++)
                { 
                    $room_price_details->pricing_details[$counts] =  new \stdClass();
                    if($starting_count > 5)
                    {
                        $tariff = Tariff::where('day',5)->first();
                    }
                    else{
                        $tariff = Tariff::where('day',$starting_count)->first();
                    }
                    
                    $room_price_details->pricing_details[$counts]->days_count = $starting_count;
                    if($request->guest_type[$k] == "guest"){
                        $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_others;
                        $per_day_price+=$tariff->rent_for_others;
                        $price+=$tariff->rent_for_others;
                        $roombooking_price[$k]['price'] = $per_day_price;
                        $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];

                    }else{
                        $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_officers_family;
                        $per_day_price_guest+=$tariff->rent_for_officers_family;
                        $price+=$tariff->rent_for_officers_family;
                        $roombooking_price[$k]['price'] = $per_day_price_guest;
                        $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];
                    }
                    $room_price_details->pricing_details[$counts]->guest_type = $request->guest_type[$k];
                    // $starting_count++;
                    $counts++; 
                } 
                $starting_count++;

            } 
        
            $k = 1;
            if(isset($request->id))
            {
            RoomBookingGuest::where('booking_id',$bookings->id)->delete();
            }
            // dd($roombooking_price);
            foreach($roombooking_price as $key=>$value)
            {
                // dd($value);
                $room_booking_guest = new RoomBookingGuest();  
                $room_booking_guest->booking_id = $bookings->id;
                $room_booking_guest->room = $k;
                $room_booking_guest->per_day_price = $value['price'];
                $room_booking_guest->guest_type = $value['guest_type'];
                $room_booking_guest->save();
                $k++;
            }
            
   
            if(isset($request->id))
            {
                $booking_price= RoomBookingPrice::where('booking_id',$request->id)->first();
            }

            else{
                $booking_price= new RoomBookingPrice();
            }
        
            $booking_price->booking_id = $bookings->id;
            $booking_price->room_price_details =json_encode($room_price_details); 
            $booking_price->total_price = $price;
            $booking_price->amount_need_to_paid = $price;
            $booking_price->save();
            
            $user = DB::table('users')->where('id', $user_id)->first();
            $phoneNumber = $user->mobile;   
            //dd($phoneNumber);
            
            // Send SMS notification
    $message = "IAS Officers' Mess: Glad to inform that a room has been reserved to the request. Thanks for using the service. If any clarification please contact Ph: 044-25366920/25366924 - TNPROT";
    $apiId = 1007114240694782877;
    //$phoneNumber = $bookings_mobile;  // Replace with the appropriate variable if needed

    $data = $this->smsContract->send1($phoneNumber, $message, $apiId);
    
    // print_r($data);
    
  $message1="IAS+Officers%27+Mess%3A+Glad+to+inform+that+a+room+has+been+reserved+to+the+request.+Thanks+for+using+the+service.+If+any+clarification+please+contact+Ph%3A+044-25366920%2F25366924+-+TNPROT";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
    $formatted_date = Carbon::createFromFormat('Y-m-d', $request->from_date)->format('d/m/Y');
    $formatted_date1 = Carbon::createFromFormat('Y-m-d', $request->to_date)->format('d/m/Y');
    $message2 = "IAS Mess: Room Confirmation: Room has been blocked at IAS Officers' mess Date : ".$formatted_date.", to ".$formatted_date1." - TNPROT";
    $apiId1 = 1007914063878652658;
    //$phoneNumber = $bookings_mobile;  // Replace with the appropriate variable if needed

    $data1 = $this->smsContract->send1($phoneNumber, $message2, $apiId1);
     
    
    $message3="IAS+Mess%3A+Room+Confirmation%3A+Room+has+been+blocked+at+IAS+Officers%27+mess+Date+%3A+".$formatted_date."%2C+to+".$formatted_date1."+-+TNPROT";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message3); // Changed from $input to $mobile
    // print_r($data1);
    //  exit;
    
    
    if (isset($request->id)) {
    // It's an update, find the existing booking
    $bookings = RoomBooking::find($request->id);

    // Send WhatsApp message for booking update
    $formatted_date_update = Carbon::createFromFormat('Y-m-d', $request->from_date)->format('d-m-Y');
    $formatted_date_update1 = Carbon::createFromFormat('Y-m-d', $request->to_date)->format('d-m-Y');
    
    $message_update = "Dear+".urlencode($user->name)."%2C%0AYour+booking+at+IAS+Officers%27+Mess+has+been+successfully+updated.+The+updated+details+are%3A%0ANew+Check-in+Date%3A+" 
        . $formatted_date_update . "%0ANew+Check-out+Date%3A+" 
        . $formatted_date_update1 . "%0ANo.+of+Rooms%3A+" 
        . $request->room . "%0ANo.+of+Guests%3A+" 
        . $request->guest;
    
    // Send WhatsApp update message
    //dd($phoneNumber);
    //dd($message_update);
    //$mobile=8056496398;
    $response_update = $this->smsContract->whatsappsend($phoneNumber, $message_update);

}
    
    
    
    
    
            if($end_count > 5)
            {  
                $response = [
                        "status" => true,
                        "message" => "Booking confirmation request submitted for Admin approval. Updates will be sent to the registered mobile number and email at the earliest."
                    ];
                if(auth()->user()->hasRole("super-user"))
                {
                    $response = [
                    "status" => true,
                    "message" => "Booking Confirmed Successfully"
                ];
                
                } 
            }
            else{
                $response = [
                    "status"=> true,
                    "message" => "Booking Confirmed Successfully"
                ]; 
            } 
            return response()->json($response);

        }

    
        public function check_availability(Request $request)
        {
            $user_id = auth()->user()->id;
            if(isset($request->user))
            { 
                $user_id = $request->user;
            } 
            // dd($request->id);
            if(isset($request->id))
            {
                $bookings = RoomBooking::where(function($query) use ($request) {
                    $query->whereBetween('checkin_date', [$request->from_date, $request->to_date])
                        ->orWhereBetween('checkout_date', [$request->from_date, $request->to_date]);
                }) 
                ->whereIn('status',[0,1]) 
                ->where('id', '!=',$request->id)
                ->get(); 
            }
            else{
                $bookings = RoomBooking::where(function($query) use ($request) {
                    $query->whereBetween('checkin_date', [$request->from_date, $request->to_date])
                        ->orWhereBetween('checkout_date', [$request->from_date, $request->to_date]);
                }) 
                ->whereIn('status',[0,1]) 
                                    ->get();
            } 
            // dd($bookings);
            // if(count($bookings) == 0)
            // {
                $checkinDate = $request->input('from_date'); // e.g., '2024-06-21'
                $checkoutDate = $request->input('to_date'); // e.g., '2024-06-22'
        
                // Convert strings to Carbon instances
                $checkin = Carbon::createFromFormat('Y-m-d', $checkinDate);
                $checkout = Carbon::createFromFormat('Y-m-d', $checkoutDate);
        
                // Calculate the difference in days
                $differenceInDays = $checkin->diffInDays($checkout); 
                $booking_count = 0;
                $requested_count = $differenceInDays * $request->room;
                $booking_count = $differenceInDays * $request->room;
                $dates = new Collection(); 
                $startDate = Carbon::parse($request->from_date);
                $endDate = Carbon::parse($request->to_date);  
                while ($startDate->lte($endDate)) {
                    $dates->push(['date' => $startDate->format('Y-m-d'), 'room_count' => 0]);
                    $startDate->addDay();
                } 
                $room_available_status = 1;

                // Iterate over bookings
                foreach ($bookings as $booking) {
                    $checkinDate = Carbon::parse($booking->checkin_date);
                    $checkoutDate = Carbon::parse($booking->checkout_date);
                    
                    // Iterate over each date and check if it falls within the booking period
                    $dates = $dates->map(function ($date) use ($checkinDate, $checkoutDate, $booking) {
                        $checkDate = Carbon::createFromFormat('Y-m-d', $date['date']);
                        
                        if ($checkDate->between($checkinDate, $checkoutDate)) {
                            $date['room_count'] += $booking->no_of_rooms;
                        }
                        
                        return $date;
                    });
                }
                $room_tariff = Tariff::get();
                $room_count = $room_tariff[0]->total_rooms;
                //  dd($dates);
                foreach($dates as $key=>$value)
                {
                $reduce_count = $room_count - $value['room_count']; 
                if($reduce_count >= $request->room)
                {
                    $room_available_status = 1;
                }
                else{
                    $room_available_status = 0;
                    break;
                }
                }
                if(!$room_available_status) 
                {
                    $response = [
                                    "status" => false,
                                    "message" => "Rooms are unavailable for the requested date. Please check the room availability tab and proceed with your booking"
                                    ];
                    return response()->json($response);
                }
                if (auth()->user()->hasRole('super-user')) {
                    $response = [
                        "status" => true,
                        "message" => "Room is Available. Please Proceed!"
                    ];
                    return response()->json($response);
                }

                $checkinDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
                $checkoutDate = Carbon::createFromFormat('Y-m-d', $request->to_date);
            
                // // Calculate the total number of days being booked
                // $differenceInDays = $checkinDate->diffInDays($checkoutDate); // +1 to include check-in day
                // // dd(count($bookings));
                // // Initialize monthly booking counts
                // $monthlyBookedDays = [];
                // foreach ($bookings as $booking) {   
                //     $bookingCheckin = Carbon::parse($booking->checkin_date);
                //     $bookingCheckout = Carbon::parse($booking->checkout_date);
                    
                //     // Loop through the months from check-in to check-out
                //     while ($bookingCheckin->lte($bookingCheckout)) {
                //         $monthKey = $bookingCheckin->format('Y-m');
            
                //         // Initialize count for the month if not set
                //         if (!isset($monthlyBookedDays[$monthKey])) {
                //             $monthlyBookedDays[$monthKey] = 0;
                //         }
            
                //         // Calculate the number of days booked in the current month
                //         if ($bookingCheckin->month === $bookingCheckout->month) {
                //             // If the booking is within the same month
                //             $daysInMonth = $bookingCheckout->day - $bookingCheckin->day + 1;
                //             $monthlyBookedDays[$monthKey] += $daysInMonth;
                //         } else {
                //             // If the booking spans multiple months
                //             $daysInMonth = $bookingCheckin->daysInMonth - $bookingCheckin->day + 1;
                //             $monthlyBookedDays[$monthKey] += $daysInMonth; // Remaining days in the check-in month
                            
                //             // Move to the next month
                //             $bookingCheckin->addMonth();
            
                //             // Count full months in between
                //             while ($bookingCheckin->month < $bookingCheckout->month) {
                //                 $monthlyBookedDays[$bookingCheckin->format('Y-m')] += $bookingCheckin->daysInMonth; // Full month
                //                 $bookingCheckin->addMonth();
                //             }
            
                //             // Add the days in the check-out month
                //             $monthlyBookedDays[$bookingCheckout->format('Y-m')] += $bookingCheckout->day; // Days in the check-out month
                //         }
            
                //         // Move to the next month
                //         $bookingCheckin->addMonth();
                //     }
                // }
            
                // // Calculate total bookings including the new request
                // $requestedBookings = $differenceInDays;
                // // dd($monthlyBookedDays);
                // // dd($requestedBookings);
                // // Check limits for each relevant month
                // foreach ($monthlyBookedDays as $month => $bookedCount) {
                //     $totalBookings = $bookedCount + ($month === $checkinDate->format('Y-m') ? $requestedBookings : 0);
                //     // dd($totalBookings);
                //     if ($totalBookings > 5) {
                //         return response()->json([
                //             "status" => false,
                //             "message" => "Booking limit exceeded for the month of {$month}. Limit: 5 days, Current: {$totalBookings} days."
                //         ]);
                //     }
                // }


                $checkinInput = $request->input('from_date');
                $checkoutInput = $request->input('to_date'); 
                // Create Carbon instances
                $checkinDate = Carbon::createFromFormat('Y-m-d', $checkinInput);
                $checkoutDate = Carbon::createFromFormat('Y-m-d', $checkoutInput); 

                // Determine the start and end of the months for check-in and check-out
                $startOfCheckinMonth1 = $checkinDate->copy()->startOfMonth(); // Use copy to avoid modifying the original
                $endOfCheckinMonth = $checkinDate->copy()->endOfMonth(); // Use copy to avoid modifying the original
                $startOfCheckoutMonth = $checkoutDate->copy()->startOfMonth(); // For the checkout date
                $endOfCheckoutMonth = $checkoutDate->copy()->endOfMonth(); // For the checkout date 
                                    // Retrieve bookings for the user in the relevant months
                    $query = RoomBooking::where(function ($query) use ($startOfCheckinMonth1, $endOfCheckoutMonth) {
                        $query->whereBetween('checkin_date', [$startOfCheckinMonth1, $endOfCheckoutMonth])
                              ->orWhereBetween('checkout_date', [$startOfCheckinMonth1, $endOfCheckoutMonth]);
                    })
                    ->where('user_id', $user_id)
                    ->whereIn('status', [0, 1, 3])
                    ->when(isset($request->id), function ($query) use ($request) {
                        return $query->where('id', '!=', $request->id);
                    });
                    $totalDaysBooked = $query->get(); 
                // Calculate the total number of days being booked (including check-in day)
            $differenceInDays = $checkinDate->diffInDays($checkoutDate) + 1; // Total days booked

// Initialize monthly booking counts
                $monthlyBookedDays = [];
// dd(count($totalDaysBooked));
// Loop through existing bookings
            foreach ($totalDaysBooked as $booking) {   
                $bookingCheckin = Carbon::parse($booking->checkin_date);
                $bookingCheckout = Carbon::parse($booking->checkout_date);
            
            // Loop through the months from check-in to check-out
            while ($bookingCheckin->lte($bookingCheckout)) {
                $monthKey = $bookingCheckin->format('Y-m');
                // echo "Dfgffgdfgdfgdgdfgdg";

                // Initialize count for the month if not set
                if (!isset($monthlyBookedDays[$monthKey])) {
                    $monthlyBookedDays[$monthKey] = 0;
                }
                echo $bookingCheckin."-------------";
                echo $bookingCheckout;
                // Calculate the number of days booked in the current month
                if ($bookingCheckin->month === $bookingCheckout->month) { 
                    // If the booking is within the same month
                    // $daysInMonth = $bookingCheckout->day - $bookingCheckin->day + 1;
                    $daysInMonth = $bookingCheckout->day - $bookingCheckin->day;
                    $monthlyBookedDays[$monthKey] += $daysInMonth; 
                   
                } else {
                    
                    // If the booking spans multiple months
                    // Remaining days in the check-in month
                    // $daysInMonth = $bookingCheckin->daysInMonth - $bookingCheckin->day + 1;
                    $daysInMonth = $bookingCheckin->daysInMonth - $bookingCheckin->day;
                    $monthlyBookedDays[$monthKey] += $daysInMonth; 
                    
                    // Move to the next month
                    $bookingCheckin->addMonth();
                  
                    // Count full months in between
                    while ($bookingCheckin->month < $bookingCheckout->month) {
                        $monthlyBookedDays[$bookingCheckin->format('Y-m')] += $bookingCheckin->daysInMonth; // Full month
                        $bookingCheckin->addMonth();
                    }
                   
                    
                    // Add the days in the check-out month
                    $monthlyBookedDays[$bookingCheckout->format('Y-m')] += $bookingCheckout->day; 
                }
              
                // Move to the next month (not necessary here due to the loop condition)
                $bookingCheckin->addMonth();
            }

        }

       
        dd($monthlyBookedDays);

        // Now calculate the total bookings including the new request
        foreach ($monthlyBookedDays as $month => $bookedCount) {
            // Determine the number of requested bookings for the current month being checked
            $requestedBookings = 0;
            if($checkinDate->format('Y-m') == $checkoutDate->format('Y-m'))
            {
                $requestedBookings = $differenceInDays - 1;
            }
            else{
                    // Calculate how many days to add to the current month based on the request
                    if ($month === $checkinDate->format('Y-m')) { 
                        // Check-in month (October) 
                        $requestedBookings += $checkinDate->daysInMonth - $checkinDate->day + 1; // 1 day (Oct 31)
                        
                    }

                    if ($month === $checkoutDate->format('Y-m')) {
                        // Check-out month (November)
                        $requestedBookings += $checkoutDate->day; // 3 days (Nov 1, 2, 3)
                    }
            }
           
            // dd($requestedBookings);
            // Total bookings for the current month being checked
            $totalBookings = $bookedCount + $requestedBookings;
            $totalBookings1 = 5 - $bookedCount; 
            // dd($totalBookings);
            // Check against the limit
            if ($totalBookings > 5) {
                return response()->json([
                    "status" => false,
                    "message" => "Booking limit exceeded for the month of {$month}. Limit: 5 days, Available days: {$totalBookings1} days."
                ]);
            }
        } 
        // exit;
        $response = [
            "status" => true,
            "message" => "Room is Available. Please Proceed!"
        ];
        return response()->json($response);
                // exit;
    // dd($dates);
                // if($booking_count > 10)
                // {
                //     $response = [
                //         "status" => false,
                //         "message" => ""
                //     ];
                //     return response()->json($response);
                // }
                // else{  
                    // $checkinDate = $request->input('from_date'); // e.g., '2024-06-21'
                    // $checkoutDate = $request->input('to_date'); // e.g., '2024-06-22' 
                    // $checkin = Carbon::createFromFormat('Y-m-d', $checkinDate);
                    // $checkout = Carbon::createFromFormat('Y-m-d', $checkoutDate);  
                    // $count = 0;
                    // $now = Carbon::now('Asia/Kolkata');
                    // $startOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s'); 
                    // $endOfMonth = $now->endOfMonth();
                    // if(isset($request->id))
                    // {
                    //     $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
                    //     ->where('user_id',$user_id)
                    //     ->whereIn('status',[0,1,3])
                    //     ->where('id', '!=',$request->id)
                    //     ->get(); 
                    // }
                    // else{
                    //     $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
                    //     ->where('user_id',$user_id)
                    //     ->whereIn('status',[0,1,3])
                    //     ->get(); 
                    // } 
                    // $booked_count = 0;
                    // foreach($totalDaysBooked as $key=>$value)
                    // {
                    //     $checkin = Carbon::parse($value->checkin_date);
                    //     $checkout = Carbon::parse($value->checkout_date);
                    //     $month_differ = $checkout->month - $checkin->month;
                    //     if($month_differ > 0)
                    //     { 
                    //     $day_count = $endOfMonth->day - $checkin->day; 
                    //     if($day_count == 0)
                    //     {
                    //     $booked_count+=1;
                    //     }
                    //     else{
                    //     $booked_count+=$day_count;
                    //     }
                    //     }
                    //     else{
                    //     $booked_count+=$value->booking_count;
                    //     }
                    // } 
                    // if($booked_count > 5)
                    // {
                    //     $response = [
                    //             "status" => false,
                    //             "message" => "Monthly quota of 5 days exceeded."
                    //         ];
                    //         return response()->json($response);
                    // }
                   
                    // if($booked_count == 5)
                    // {
                    //     $response = [
                    //         "status" => false,
                    //         "message" => "Booking limit Exceeded for the month. Remaining days available: 0"
                    //     ];
                    //     return response()->json($response);
                    // }
 // Get the check-in and check-out dates from the request
// $checkinInput = $request->input('from_date');
// $checkoutInput = $request->input('to_date'); 
// // Create Carbon instances
// $checkinDate = Carbon::createFromFormat('Y-m-d', $checkinInput);
// $checkoutDate = Carbon::createFromFormat('Y-m-d', $checkoutInput); 

// // Determine the start and end of the months for check-in and check-out
// $startOfCheckinMonth1 = $checkinDate->copy()->startOfMonth(); // Use copy to avoid modifying the original
// $endOfCheckinMonth = $checkinDate->copy()->endOfMonth(); // Use copy to avoid modifying the original
// $startOfCheckoutMonth = $checkoutDate->copy()->startOfMonth(); // For the checkout date
// $endOfCheckoutMonth = $checkoutDate->copy()->endOfMonth(); // For the checkout date 
//                     // Retrieve bookings for the user in the relevant months
//                     $query = RoomBooking::where(function ($query) use ($startOfCheckinMonth1, $endOfCheckoutMonth) {
//                         $query->whereBetween('checkin_date', [$startOfCheckinMonth1, $endOfCheckoutMonth])
//                               ->orWhereBetween('checkout_date', [$startOfCheckinMonth1, $endOfCheckoutMonth]);
//                     })
//                     ->where('user_id', $user_id)
//                     ->whereIn('status', [0, 1, 3])
//                     ->when(isset($request->id), function ($query) use ($request) {
//                         return $query->where('id', '!=', $request->id);
//                     });
                    
                    // Get the raw SQL query
                    // $totalDaysBooked = $query->get(); 
                    // $monthlyBookedDays = [];
                    // dd(count($totalDaysBooked));
                    // foreach ($totalDaysBooked as $booking) { 
                    //     $this->updateMonthlyBookingCounts($monthlyBookedDays, $booking);
                    // }
                    // dd($monthlyBookedDays);
                    // Calculate total booked days across both months
                    // $totalUserBookedDays = 0;
                    // foreach ($monthlyBookedDays as $month => $days) {
                    //     $totalUserBookedDays += $days;
                    // }
                    // dd($totalUserBookedDays);
                    // Check for limits in each month
                    // $exceededMonths = [];
                    // foreach ($monthlyBookedDays as $month => $days) {
                    //     if ($days >= 5) {
                    //         $exceededMonths[] = $month;
                    //     }
                    // }
                
                    // If any month has reached the limit, return the message
                    // if (!empty($exceededMonths)) {
                    //     $monthList = implode(', ', $exceededMonths);
                    //     return response()->json([
                    //         "status" => false,
                    //         "message" => "You have reached your monthly booking limit of 5 days on the following month(s): {$monthList}. Current total: {$totalUserBookedDays} days."
                    //     ]);
                    // }


                    // $req_booked_count = $differenceInDays + $booked_count;
                
                //    dd($req_booked_count);
                    // if($req_booked_count > 5)
                    // {
                    //     $reduce_booked_count = 5 - $booked_count; 
                    //     if($reduce_booked_count > 0)
                    //     {
                    //         $response = [
                    //             "status" => false,
                    //             "message" => "Booking limit Exceeded for the month. Remaining days available: ".$reduce_booked_count.""
                    //         ];
                           
                    //     }
                    //     else{
                    //         $response = [
                    //             "status" => false,
                    //             "message" => "Booking limit Exceeded for the month."
                    //         ]; 
                    //     }
                    //     return response()->json($response);

                    // }
                    // else{
                    //     $response = [
                    //             "status" => true,
                    //             "message" => "Room is Available. Please Proceed!"
                    //         ];
                    //         return response()->json($response);
                    // }
                    // $count = 0;
                    // dd($bookings);
                    // foreach($bookings as $key=>$value)
                    // {   
                    //     $count+=$value->no_of_rooms;
                    // } 
                
                
                    // dd($count);
                    // if($count < $room_count)
                    // { 
                    //     $reduce_count = $room_count - $count;
                        
                    //     if($request->room <= $reduce_count)
                    //     {
                    //         $response = [
                    //             "status" => true,
                    //             "message" => "Room is Available. Please Proceed!"
                    //         ];
                    //         return response()->json($response);
                    //     }
                    //     else{

                    //         // dd("test");
                    //         // dd("gfdgfd");
                    //         $response = [
                    //             "status" => false,
                    //             "message" => "Rooms are unavailable for the requested date. Please check the room availability tab and proceed with your booking"
                    //         ];
                    //         return response()->json($response);
                    //     }
                    // }
                    // else{
                    //     $response = [
                    //         "status" => false,
                    //         "message" => "Rooms are unavailable for the requested date. Please check the room availability tab and proceed with your booking"
                    //     ];
                    //     return response()->json($response);
                    // } 
                // }
            
            
            // } 
            return response()->json($response);
        }


        private function updateMonthlyBookingCounts(&$monthlyBookedDays, $booking)
{
    $checkin = Carbon::parse($booking->checkin_date);
    $checkout = Carbon::parse($booking->checkout_date);

    // Loop through the months and count booked days
    while ($checkin->lte($checkout)) {
        $monthKey = $checkin->format('Y-m');

        // Initialize count for the month if not set
        if (!isset($monthlyBookedDays[$monthKey])) {
            $monthlyBookedDays[$monthKey] = 0;
        }

        // If the booking is within the same month
        if ($checkin->month === $checkout->month) {
            $daysInMonth = $checkout->day - $checkin->day;
            // $daysInMonth = $checkout->day - $checkin->day + 1;
            // echo $daysInMonth."-----";
            $monthlyBookedDays[$monthKey] += $daysInMonth;
        } else {
            // Remaining days in the check-in month
            // $daysInMonth = $checkin->daysInMonth - $checkin->day + 1;
            $daysInMonth = $checkin->daysInMonth - $checkin->day;
            $monthlyBookedDays[$monthKey] += $daysInMonth;

            // Move to the next month and count full months
            $checkin->addMonth();
            while ($checkin->month < $checkout->month) {
                $monthlyBookedDays[$checkin->format('Y-m')] += $checkin->daysInMonth;
                $checkin->addMonth();
            }

            // Add days in the checkout month
            $monthlyBookedDays[$checkout->format('Y-m')] += $checkout->day;
        }

        // Move to the next month
        $checkin->addMonth();
    }
}


        public function availability_view()
        { 
            $page = trans('pages_names.types');
            $main_menu = 'availabilty-view';
            $sub_menu = '';
            $sub_menu_1 = '';
            $user = $this->user->belongsTorole(Role::USER)->get(); 
            return view('admin.types.availability_view', compact('page', 'main_menu', 'sub_menu','sub_menu_1','user'))->render(); 
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
            $tariff = Tariff::get();
            $room_count = $tariff[0]->total_rooms;
            $data_content = ' <div class="box-body no-padding"><div class="table-responsive"><table class="table table-hover"><thead><tr><th>Date</th>';
            for($i=1;$i<=$room_count;$i++)
            {
                $data_content.=' <th>Room '.$i.'</th>';
            }
            $data_content.= '</thead><tbody>';

        
            for($i=0;$i<=9;$i++)
            { 
                $nextDay = $now->copy()->addDays($i)->format('Y-m-d'); 
                $total_booking_count = RoomBooking::where(function($query) use ($nextDay) {
                    $query->whereDate('checkin_date', '<=', $nextDay)
                        ->whereDate('checkout_date', '>=', $nextDay);
                })
                ->whereIn('status', [0, 1]) 
                ->selectRaw('SUM(no_of_rooms) as total_booking_count')
                ->first();  
                $date_format = $now->copy()->addDays($i)->format('d-M-Y');
                $tr_content = '<tr>';
                $tr_content.='<td style=" background-color: #86bebd;color: white;"> '.$date_format.'</td>';
                for($k=1;$k<=$room_count;$k++)
                { 
                    if($total_booking_count->total_booking_count != null)
                    {
                        if($k <= $total_booking_count->total_booking_count)
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
                $data_content .= '<li class="page-item"><span class="page-link" aria-hidden="true">&lsaquo;</span></li>';
            }
            $min = 1;
            // Front dots
            if ($type > $first_page + 5) { // Adjusted to +2 for showing two pages before dots
                $min = $type - 2;
                $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch">1</a></li>';
                $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch?type=2">2</a></li>'; // Added the second page
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
                $content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch?type='. ($last_page - 1) .'">' . ($last_page - 1) . '</a></li>'; // Added the second to last page
                $content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch?type='.$last_page.'">'.$last_page.'</a></li>';
            } else{
                $min = $last_page - $center_view; 
                $max =  $last_page; 
            } 
            for ($i = $min; $i <= $max; $i++) {
                if ($i == $type) {
                    $data_content .= '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                } else {
                    $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch?type='.$i.'">'.$i.'</a></li>';
                }
            } 
            $data_content .=$content; 
            // Next button
            if ($type == $last_page) {
                $data_content .= '<li class="page-item disabled"><span class="page-link" aria-hidden="true">&rsaquo;</span></li>';
            } else {
                $data_content .= '<li class="page-item"><a class="page-link" href="'.url('/').'/types/availability-view/fetch?type='.($type+1).'">&rsaquo;</a></li>';
            } 
            $data_content.='</ul></nav></span></div></div></div>';   
            // dd($results->links());
            return view('admin.types.availability_view_types', compact('data_content'))->render(); 
        }
    
        /**
        * Edit Vehicle type view
        *
        */
        public function edit(RoomBooking $booking)
        {   
            // dd($booking);
            $page = trans('pages_names.edit_type'); 
            // dd($type->is_taxi);
            // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
            // $services = ServiceLocation::whereActive(true)->get();
            $main_menu = 'master';
            $sub_menu = 'types';
            $sub_menu_1 = '';
            // dd($booking->booking_guest_details);
            $user = $this->user->belongsTorole(Role::USER)->get(); 
            return view('admin.types.update', compact('page','main_menu', 'sub_menu','sub_menu_1','user','booking'));
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

                return redirect('types')->with('warning', $message);
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
            return redirect('types')->with('success', $message);
        }
        public function toggleStatus(VehicleType $vehicle_type)
        {
            if (env('APP_FOR')=='demo') {
                $message = trans('succes_messages.you_are_not_authorised');

                return redirect('types')->with('warning', $message);
            }
            
            $status = $vehicle_type->active == 1 ? 0 : 1;
            $vehicle_type->update([
                'active' => $status
            ]);

            $message = trans('succes_messages.type_status_changed_succesfully');
            return redirect('types')->with('success', $message);
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

                return redirect('types')->with('warning', $message);
            }

            $vehicle_type->delete();

            $message = trans('succes_messages.vehicle_type_deleted_succesfully');
            return $message;
        }
// public function cancel_booking(PartyBooking $booking)
// {
//     // Find and update the booking
//     $booking = PartyBooking::find($booking->id);
//     $booking->status = 2;
//     $booking->cancelled_by = auth()->user()->id;

//     // Set the current date and time
//     $timezone = 'Asia/Kolkata';
//     $currentDateTime = Carbon::now($timezone);
//     $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
//     $booking->cancelled_on = $formattedDateTime;
//     $booking->save();

//     // Fetch the mobile number from the users table
//     $user = DB::table('users')->where('id', $booking->user_id)->first();
//     $phoneNumber = $user->mobile;  // Assuming the mobile number column is named 'mobile'

//     // Prepare the SMS message
//     $message = "IAS Officers' Mess: Dear {$user->name}, With reference to your Party Lawn/Party Hall Booking ID {$booking->id}, we regret to inform you that your booking has been cancelled as per your request. A refund for the cancelled booking has been initiated.";
//     $apiId = 1007804631229240779; // Use the specified API ID

//     // Send the SMS
//     $data = $this->smsContract->send1($phoneNumber, $message, $apiId);

//     // Return the response
//     return response()->json([
//         "status" => true,
//         "message" => "Booking Cancelled Successfully and SMS sent.",
//         "sms_response" => $data, // Include the SMS response
//     ]);
// }

      public function cancel_booking(RoomBooking $booking)
{
    $booking = RoomBooking::find($booking->id);
    $booking->status = 2; 
    $booking->cancelled_by = auth()->user()->id;
    $user = $booking->user;
    $timezone = 'Asia/Kolkata'; 
    // Get the current date and time in the specified timezone
    $currentDateTime = Carbon::now($timezone); 
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    $booking->cancelled_on = $formattedDateTime;
    $booking->save();
    
    $phoneNumber = $user->mobile;
    
    // Prepare the message based on who canceled the booking
    if (auth()->user()->hasRole('super-user')) {
        // If admin cancels the booking
        $message_cancel = "Dear".urlencode($user->name)."%2C%0AYour+room+booking+at+IAS+Officers+Mess+for+" . Carbon::parse($booking->checkin_date)->format('d-m-Y') . "+has+been+successfully+cancelled.";
        $response_1 = $this->smsContract->whatsappsend($phoneNumber,$message_cancel);
        
        //dd($message_cancel);
    } else {
        // If the user cancels the booking
        $message2 = "IAS Officers' Mess: Dear {$user->name}, With reference to your Booking ID ".$booking->booking_id.", we regret to inform you that your booking has been cancelled as per your request - TNPROT";
        $apiId2 = 1007128070485749780;
        $this->smsContract->send1($phoneNumber, $message2, $apiId2);

        $message1 = "IAS+Officers%27+Mess%3A+Dear+".urlencode($user->name)."%2C+With+reference+to+your+Booking+ID+".$booking->booking_id."%2C+we+regret+to+inform+you+that+your+booking+has+been+cancelled+as+per+your+request+-+TNPROT";
        $response = $this->smsContract->whatsappsend($phoneNumber, $message1);
    }
    
    // Return response
    $message = [
        "status" => true,
        "message" => "Booking Cancelled Successfully",
    ];
    
    return response()->json($message);
}




      public function approve_booking(RoomBooking $booking)
{
    // Find the booking and update its approval status
    $booking = RoomBooking::find($booking->id);
    $booking->is_admin_approve = 1;
    $booking->save();

    // Fetch the mobile number from the users table
    $user = DB::table('users')->where('id', $booking->user_id)->first();
    $phoneNumber = $user->mobile;  // Assuming the mobile number column is named 'mobile_number'

    // Prepare the SMS message
    $message = 'IAS Officers\' Mess: Glad to inform that a room has been reserved to the request. Thanks for using the service. If any clarification please contact Ph: 044-25366920/25366924 - TNPROT';
    $apiId = 1007114240694782877;

    // Send SMS
    $data = $this->smsContract->send1($phoneNumber, $message, $apiId);
    
    

    // Prepare the response message
    $response = [
        "status" => true,
        "message" => "Booking Confirmed Successfully. An SMS notification has been sent to the user."
    ];

    return response()->json($response);
}

        public function export(RoomBooking $booking)
        {  
            
            $room_booking_price = RoomBookingPrice::where('booking_id',$booking->id)->first();
            $booking_guest_details = RoomBookingGuest::where('booking_id',$booking->id)->get();
            // dd($booking_guest_details);
            $invoice = Invoice::where('booking_id',$booking->id)->first();
            $user_details = User::where('id',$booking->user_id)->first();
            // dd($booking);
            $data = [
                'booking' => $booking->toArray(),
                'invoice' => $invoice->toArray(),
                'booking_guest_details' => $booking_guest_details->toArray(),
                'room_booking_price' => $room_booking_price->toArray(),
                'user_details' => $user_details->toArray()
            ];
            // print_r($data);
            // exit;
            $pdf = PDF::loadView('pdf.user', $data);  
            return $pdf->download('invoice_'.time().'.pdf');
        }
public function confirm_checkin(RoomBooking $booking, Request $request)
{
    $now = Carbon::now('Asia/Kolkata');
    $checkin_times = $now->format('Y-m-d H:i:s'); 
    $startOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s'); 
    $endOfMonth = $now->endOfMonth()->format('Y-m-d H:i:s');

    $totalDaysBooked = DB::table('room_booking')
        ->whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
        ->where('user_id', $booking->user_id)
        ->whereIn('status', [0, 1, 3])
        ->where('id', '!=', $booking->id)
        ->get();

    $booking_count = 0;
    foreach ($totalDaysBooked as $key => $value) {
        $checkin = Carbon::parse($value->checkin_date);
        $checkout = Carbon::parse($value->checkout_date);
        $month_differ = $checkout->month - $checkin->month;
        if ($month_differ > 0) { 
            $day_count = $endOfMonth->day - $checkin->day; 
            if ($day_count == 0) {
                $booking_count += 1;
            } else {
                $booking_count += $day_count;
            }
        } else {
            $booking_count += $value->booking_count;
        }
    }

    $checkinDate = $request->input('date'); 
    $checkoutDate = $booking->checkout_date;

    // Ensure $checkinDate is parsed as 'd-m-Y'
    $checkin = Carbon::createFromFormat('d-m-Y', $checkinDate)->startOfDay();

    // Ensure $checkoutDate is parsed as 'Y-m-d H:i:s'
    $checkout = Carbon::createFromFormat('Y-m-d H:i:s', $checkoutDate)->startOfDay();

    // Calculate the difference in days
    $differenceInDays = $checkin->diffInDays($checkout);

    $booking_counts = $differenceInDays * $booking->no_of_rooms;
    $room_price_details = new \stdClass(); 
    $counts = 0;
    $price = 0;
    $per_day_price = 0;
    $per_day_price_guest = 0;
    $starting_count = $booking_count + 1;

    // Calculate the price details based on guest type and day count
    for ($i = 1; $i <= $differenceInDays; $i++) {  
        
        for ($k = 1; $k <= $booking->no_of_rooms; $k++) {
            $room_price_details->pricing_details[$counts] = new \stdClass();
 
            if ($starting_count < 5) { 
                
                $tariff = Tariff::where('day', $starting_count)->first();
            } else {
                
                $tariff = Tariff::where('day', 5)->first();
            }
            // dd($tariff);

            if (!$tariff) {
                // Handle the case where no tariff is found
                return response()->json([
                    'success' => false,
                    'message' => "No tariff found for day {$starting_count}.",
                    'status_code' => 500
                ], 500);
            }

            $room_price_details->pricing_details[$counts]->days_count = $starting_count;
            if ($request->guest_type[$k] == "guest") {  
                $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_others;
                $per_day_price += $tariff->rent_for_others;
                $price += $tariff->rent_for_others;
                $roombooking_price[$k]['price'] = $per_day_price;
                $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];
            } else { 
                $room_price_details->pricing_details[$counts]->price = $tariff->rent_for_officers_family;
                $per_day_price_guest += $tariff->rent_for_officers_family;
                $price += $tariff->rent_for_officers_family;
                $roombooking_price[$k]['price'] = $per_day_price_guest;
                $roombooking_price[$k]['guest_type'] = $request->guest_type[$k];
            }
            $room_price_details->pricing_details[$counts]->guest_type = $request->guest_type[$k];
            $starting_count++;
            $counts++;
        } 
    } 

    if (isset($request->eta)) { 
        $response = [
            "status" => true,
            "data" => $price,
            "message" => "Checkin Confirmed Successfully",
        ];
        return response()->json($response);
    } 

    $k = 1;
    if (isset($request->id)) { 
        RoomBookingGuest::where('booking_id', $request->id)->delete();
    } 

    foreach ($roombooking_price as $key => $value) { 
        $room_booking_guest = new RoomBookingGuest();  
        $room_booking_guest->booking_id = $request->id;
        $room_booking_guest->room = $k;
        $room_booking_guest->per_day_price = $value['price'];
        $room_booking_guest->guest_type = $value['guest_type'];
        $room_booking_guest->save();
        $k++;
    }

    if (isset($request->id)) {
        $booking_price = RoomBookingPrice::where('booking_id', $request->id)->first();
    } else {
        $booking_price = new RoomBookingPrice();
    }
    $booking_price->booking_id = $booking->id;
    $booking_price->room_price_details = json_encode($room_price_details); 
    $booking_price->total_price = $price; 
    $booking_price->amount_need_to_paid = $price;

    $now = Carbon::now('Asia/Kolkata');
    $invoice = new Invoice();
    $invoice_number = Invoice::orderBy('created_at', 'DESC')->pluck('invoice_number')->first();

    if ($invoice_number) {
        preg_match('/(\d+)$/', $invoice_number, $matches);
        $numberPart = isset($matches[1]) ? intval($matches[1]) + 1 : 500001;
        $invoice_number = str_pad($numberPart, 6, '0', STR_PAD_LEFT);
    } else {
        $invoice_number = "500001";
    } 
    $invoice->invoice_number =  $invoice_number;
    $invoice->booking_id =  $request->id;
    $invoice->customer_id =  $booking->user_id;
    $invoice->issue_date =  $now->format("Y-m-d");
    $invoice->due_date =  $booking->checkout_date;
    $invoice->total_amount =  $price;  
    $booking_price->initial_price = 0;
    $booking_price->initial_price_status = 0;
    // dd($request->price);
    if ($request->amount) { 
        $booking_price->initial_price = $request->price ?? 0;
        $booking_price->initial_price_status = 1;
        $invoice->initial_price = $request->price ?? 0;
        $invoice->initial_price_status = 1;
        $booking_price->amount_need_to_paid = $price - $request->price; 
        $invoice->amount_need_to_paid = $price - $request->price;  
    } 
    $invoice->status =  1;
    $booking_price->save();
    $invoice->save();

    $booking->actual_checkin_date = $checkin_times;
    $booking->checkout_date = $booking->checkout_date;
    $booking->status = 1;
    $booking->save(); 
    
  
    
    // $user = DB::table('users')->where('id', $booking->user_id)->first();
    // $phoneNumber = $user->mobile;
    // $name = $user->name;
    
    // $message_cancel = "Dear+".urlencode($name)."%2C%0AThis+is+a+reminder+for+your+upcoming+check-in+for+booking+at+IAS+Officers+Mess.+Please+check+in+on+" . Carbon::parse($booking->checkin_date)->format('d-m-Y') . "%5D.";
    // $response_1 = $this->smsContract->whatsappsend(8056496398,$message_cancel);

        return response()->json([
            "status" => true,
            "message" => "Check-in confirmed successfully.",
        ]);
     
}



      public function confirm_checkout(RoomBooking $booking, Request $request)
{
    try {
        $now = Carbon::now('Asia/Kolkata');
        $checkin_times = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s'); 

        // Calculate booking count for the current month
        $startOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s'); 
        $endOfMonth = $now->endOfMonth(); 

        $totalDaysBooked = RoomBooking::whereBetween('checkin_date', [$startOfMonth, $endOfMonth])
            ->where('user_id', $booking->user_id)
            ->whereIn('status', [0, 1, 3])
            ->where('id', '!=', $booking->id)
            ->get();

        $booking_count = 0;
        foreach ($totalDaysBooked as $value) {
            $checkin = Carbon::parse($value->checkin_date);
            $checkout = Carbon::parse($value->checkout_date);
            $month_differ = $checkout->month - $checkin->month;

            if ($month_differ > 0) { 
                $day_count = $endOfMonth->day - $checkin->day; 
                $booking_count += ($day_count == 0) ? 1 : $day_count;
            } else {
                $booking_count += $value->booking_count;
            }
        }

        $starting_count = $booking_count + 1;  
        $eta_checkout_time = Carbon::parse($booking->actual_checkin_date, 'Asia/Kolkata');

        // Calculate the difference in days between check-in and current time
        $differenceInSeconds = $eta_checkout_time->diffInSeconds($checkin_times); 
        $differenceInHours = $differenceInSeconds / 3600; 
        $differenceInMinutes = floor(($differenceInSeconds % 3600) / 60); 
        $differenceInHours = round($differenceInHours, 2);  
        $days = floor($differenceInHours / 24);
        $hours = $differenceInHours % 24; 
        $total_hours = $hours + $differenceInMinutes;
        

        if ($total_hours >= 1) {
            $days++;
        } 

        // Fetch booking prices and decode the JSON data
        $booking_price = RoomBookingPrice::where('booking_id', $booking->id)->first();
        $room_price_details = json_decode($booking_price->room_price_details, true);

        $price = 0;

        if (isset($room_price_details['pricing_details']) && !empty($room_price_details['pricing_details'])) {
            $roombooking_price = []; // Initialize array to store room booking prices

            foreach ($room_price_details['pricing_details'] as $detail) {
                $price += $detail['price']; // Add price to total price
                $roombooking_price[] = [
                    'price' => $detail['price'],
                    'guest_type' => $detail['guest_type']
                ];
            }
        } else {
            \Log::error('No pricing details found for this booking.');
            return response()->json([
                "status" => false,
                "message" => "No pricing details found for this booking.",
            ], 400);
        }

        \Log::info('Calculated Price before additional charges: ' . $price);

        // Update or create new RoomBookingGuest entries based on the processed data
        RoomBookingGuest::where('booking_id', $booking->id)->delete();

        foreach ($roombooking_price as $value) { 
            $room_booking_guest = new RoomBookingGuest();  
            $room_booking_guest->booking_id = $booking->id;
            $room_booking_guest->room = 1; // Assuming room is 1, adjust based on your logic
            $room_booking_guest->per_day_price = $value['price'];
            $room_booking_guest->guest_type = $value['guest_type'];
            $room_booking_guest->save();
        } 

        // Fetch the invoice
        $invoice = Invoice::where('booking_id', $booking->id)->first();

        if (!$invoice) {
            \Log::error('Invoice not found for booking ID: ' . $booking->id);
            return response()->json([
                "status" => false,
                "message" => "Invoice not found for this booking.",
            ], 404);
        }

        if ($invoice->initial_price_status == 1) {
            $invoice->amount_need_to_paid = $price - $invoice->initial_price;
        }

        if ($request->add_charge) {  
            $invoice->additional_charge = $request->price; 
            $price += $request->price;
        }

        \Log::info('Final Price with additional charges: ' . $price);

        // Update the total amount in the invoice
        $invoice->total_amount = $price;
        $invoice->save(); 

        // Update RoomBooking with checkout information
        $booking->actual_checkout_date = $checkin_times;
        $booking->status = 3;
        $booking->is_paid = 1;
        $booking->save();

        $response = [
            "status" => true,
            "message" => "Checkout Confirmed Successfully",
        ];
        return response()->json($response);
    } catch (\Exception $e) {
        \Log::error('Error during checkout: ' . $e->getMessage());

        return response()->json([
            "status" => false,
            "message" => "An error occurred during checkout: " . $e->getMessage(),
        ], 500);
    }
}


public function getTariff(Request $request)
{
    $day = $request->input('day');
    $guestType = $request->input('guest_type');
    if($day > 5)
    {
        $day = 6;
    }
    $tariff = Tariff::where('day', $day)->first();

    if ($tariff) {
        $price = ($guestType === 'guest') ? $tariff->rent_for_others : $tariff->rent_for_officers_family;

        return response()->json(['success' => true, 'price' => $price]);
    } else {
        return response()->json(['success' => false, 'message' => 'Tariff not found']);
    }
}














        /**
        * Get Types by admin for ajax
        *cancel_booking
        */
public function view_invoice(Request $request, QueryFilterContract $queryFilter, RoomBooking $booking)
{
    $page = trans('pages_names.types');
    $main_menu = 'master';
    $sub_menu = 'types';
    $sub_menu_1 = '';

    $query = RoomBooking::where('booked_by', auth()->user()->id); 
    $invoice = Invoice::where('booking_id', $booking->id)->first(); 

    $checkinDate = Carbon::parse($booking->checkin_date);
    $currentDate = Carbon::now('Asia/Kolkata');
    $daysDifference = $currentDate->diffInDays($checkinDate);
    $date_diff = $checkinDate->day - $currentDate->day;

    // Decode the room price details JSON
    $pricing_details = json_decode($booking->booked_price->room_price_details, true);

    return view('admin.room_booking.invoice', compact('page', 'main_menu', 'sub_menu', 'sub_menu_1', 'booking', 'date_diff', 'invoice', 'pricing_details'))->render();
}

    }
