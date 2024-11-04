<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Request\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use App\Jobs\NoDriverFoundNotifyJob;
use App\Base\Constants\Masters\PushEnums;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Transformers\Requests\CronTripRequestTransformer;
use App\Models\Request\DriverRejectedRequest;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Log;
use App\Jobs\Notifications\SendPushNotification; 
use App\Models\Request\RequestCycles; 
use Illuminate\Support\Collection;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers; 
use App\Models\User;
use App\Base\Constants\Setting\Settings;
use App\Models\RoomBooking;
use App\Models\UsersMembership;
use App\Base\Libraries\SMS\SMSContract;
use Mail;
use App\Models\MembershipTariff;
use App\Jobs\Notifications\Auth\Registration\UserNotification;


class AssignDriversForRegularRides extends Command
{
    use FetchDriversFromFirebaseHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign_drivers:for_regular_rides';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Drivers for regular rides';
    
     protected $smsContract;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database,SMSContract $smsContract)
    {
        $this->database = $database;
        $this->smsContract = $smsContract;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {  
        // $today = now()->toDateString();
        
        $today = now()->setTimezone('Asia/Kolkata')->toDateString();
        
        $dateOneMonthLater = Carbon::now()->addMonth();
        
         $tomorrow = Carbon::tomorrow(); // Get tomorrow's date

        // Fetch items expiring tomorrow
        
        Log::info("===========================================================================");
        Log::info($today);
        
        //  $get_all_unbooked_datas = RoomBooking::where('status',0)
        //                         ->get();
        // Log::info($get_all_unbooked_datas); 
        
       RoomBooking::whereDate('checkout_date', $today)
                                ->where('status',0)
                                ->update(['status'=>2]);
        Log::info("===========================================================================testtest");
        
         $user_membership_data = UsersMembership::with('user')->whereDate('expiry_date', $dateOneMonthLater)->where('is_paid',1)->where('is_expiry',0)->where('is_lifetime_member',0) ->whereHas('user', function($query) {
                $query->where('is_approve', 1)->where('active', 1);  // Only include approved users
            })->get();
         $user_membership_data_one = UsersMembership::with('user')->whereDate('expiry_date', $tomorrow)->where('is_paid',1)->where('is_expiry',0)->where('is_lifetime_member',0)->whereHas('user', function($query) {
                $query->where('is_approve', 1)->where('active', 1);  // Only include approved users
            })->get();
         $user_membership_data_expiry = UsersMembership::with('user')
                                        ->whereDate('expiry_date', $today)
                                        ->where('is_paid',1)
                                        ->where('is_expiry',0)
                                        ->where('is_lifetime_member',0)
                                        ->whereHas('user', function($query) {
                                            $query->where('is_approve', 1)->where('active', 1); 
                                         })->get();
         Log::info($user_membership_data_expiry);
         Log::info($today);
         Log::info($tomorrow);
         foreach($user_membership_data as $key=>$value)
         {
              $user_data = User::find($value->user_id); 
              $phoneNumber = $user_data->mobile; 
              Log::info($value->expiry_date);
              try {
                   $date = Carbon::parse($value->expiry_date);
                } catch (\Exception $e) {
                    Log::error('Invalid date format: ' . $value->expiry_date);
                    return; // Handle the error as needed
                } 

              // Format the date as "14th June, 2024"
              $formattedDate = $date->formatLocalized('%e %B, %Y'); 
              // Add the suffix (st, nd, rd, th) for the day
              $day = $date->day;
              $suffix = match (true) {
                in_array($day % 10, [1]) && !in_array($day % 100, [11]) => 'st',
                in_array($day % 10, [2]) && !in_array($day % 100, [12]) => 'nd',
                in_array($day % 10, [3]) && !in_array($day % 100, [13]) => 'rd',
                default => 'th',
             };
            
            $finalFormattedDate = $day . $suffix . ' ' . $date->format('F, Y');
             // Second message
                $message2 = "IAS Officers' Mess: Your IAS Officers' Mess Associate Membership is going to expire on {$finalFormattedDate}. The membership renewal process has been shared via email. Kindly renew it before {$finalFormattedDate} - TNPROT";
                $apiId2 = 1007704256730109425; 
                
                $this->smsContract->send1($phoneNumber, $message2, $apiId2);
                
                $message1="IAS+Officers%27+Mess%3A+Your+IAS+Officers%27+Mess+Associate+Membership+is+going+to+expire+on+".urlencode($formattedDate).".+The+membership+renewal+process+has+been+shared+via+email.+Kindly+renew+it+before+".urlencode($formattedDate)."+-+TNPROT";
                $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
         } 
         foreach($user_membership_data_one as $key=>$value)
         {
              $user_data = User::find($value->user_id); 
              $phoneNumber = $user_data->mobile;
              Log::info($value->expiry_date);
              try {
                   $date = Carbon::parse($value->expiry_date);
                } catch (\Exception $e) {
                    Log::error('Invalid date format: ' . $value->expiry_date);
                    return; // Handle the error as needed
                } 

              // Format the date as "14th June, 2024"
              $formattedDate = $date->formatLocalized('%e %B, %Y'); 
              // Add the suffix (st, nd, rd, th) for the day
              $day = $date->day;
              $suffix = match (true) {
                in_array($day % 10, [1]) && !in_array($day % 100, [11]) => 'st',
                in_array($day % 10, [2]) && !in_array($day % 100, [12]) => 'nd',
                in_array($day % 10, [3]) && !in_array($day % 100, [13]) => 'rd',
                default => 'th',
             };
            
            $finalFormattedDate = $day . $suffix . ' ' . $date->format('F, Y');
             // Second message
               $message2 = "IAS Officers' Mess: Your IAS Officers' Mess Associate Membership is going to expire on {$finalFormattedDate}. The membership renewal process has been shared via email. Kindly renew it before {$finalFormattedDate} - TNPROT";
                $apiId2 = 1007704256730109425; 
                
                $this->smsContract->send1($phoneNumber, $message2, $apiId2);
                
                $message1="IAS+Officers%27+Mess%3A+Your+IAS+Officers%27+Mess+Associate+Membership+is+going+to+expire+on+".urlencode($formattedDate).".+The+membership+renewal+process+has+been+shared+via+email.+Kindly+renew+it+before+".urlencode($formattedDate)."+-+TNPROT";
                $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
                // Log::info($response);
               
         } 
         foreach($user_membership_data_expiry as $key=>$value)
         {
              $user_data = User::find($value->user_id); 
              $user_data->is_approve = 0; 
              $user_data->is_payment_done = 0;
              $user_data->save();
              Log::info("Usermembership value");
              Log::info($value);
              $get_membership_tariff = MembershipTariff::find(2);
              $member_ship_data = new UsersMembership();
              $member_ship_data->user_id = $user_data->id;
              $member_ship_data->membership_type = 2;
              $member_ship_data->date = Carbon::now('Asia/Kolkata')->format("Y-m-d H:i:s");
              $member_ship_data->amount = $get_membership_tariff->price;
              $expiryDate = Carbon::now('Asia/Kolkata')->addYears(3)->format("Y-m-d H:i:s");
              \Log::info("Expiry Date: " . $expiryDate); // Check the log for the expiry date
              $member_ship_data->expiry_date = $expiryDate;
              $member_ship_data->is_lifetime_member = $get_membership_tariff->membership_type;
              $member_ship_data->is_paid = 0;
              $member_ship_data->save(); 

              $phoneNumber = $user_data->mobile;
             // Second message
                $message2 = "IAS Officers' Mess: Dear {$user_data->name}, You have successfully submitted the membership registration form. Your membership registration id {$user_data->userid}. -TNPROT";
                $apiId2 = 1007833553441484189; 
                
                $this->smsContract->send1($phoneNumber, $message2, $apiId2); 
                UsersMembership::where('id',$value->id)->update(['is_expiry'=>1]); 
                $user_data->is_active = 1;
                
                $details = [
                    'title' => "Mail from IAS Officers' App - Membership Renewal",
                    'user_details' => $user_data,
                    'type' => 'membership_renewal'
                ]; 
                // Send the email with the payment link
                Mail::to($user_data->email)->send(new UserNotification($details));
         } 
        
    }
}
