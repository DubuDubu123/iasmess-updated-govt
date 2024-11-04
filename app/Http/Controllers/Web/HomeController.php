<?php
 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use App\Models\PartyBooking; 
use App\Models\RoomBookingPrice;
use Illuminate\Http\Request;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use DB;
use Twilio;
use App\Models\User;
use App\Base\Libraries\SMS\SMSContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Helpers\Exception\ExceptionHelpers;
use App\Base\Constants\Auth\Role; 
use App\Jobs\Notifications\Auth\Registration\UserNotification;
use Mail;
use Log;
use App\Models\MobileOtp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Session;
use App\Models\MembershipTariff;
use App\Models\UsersMembership;
use App\Models\Invoice;
use League\Csv\Reader;
use Carbon\Carbon;
use Validator; 
use App\Models\RoomBookingGuest;

class HomeController extends LoginController
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
    public function payment_link1(RoomBooking $booking,$payment_link)
    { 
     $get_booking_data = RoomBooking::where('id',$booking->id)->where('payment_link',$payment_link)->first();
     $user = User::find($booking->user_id);
        if($get_booking_data)
        {  
                 $booking_price = RoomBookingPrice::where('booking_id',$booking->id)->first();
                 $invoice = Invoice::where('booking_id',$booking->id)->first();
                 $orderid = $booking_price->booking_id; 
                 $MerchantId = "1000356"; 
                 if($booking->status == 3)
                 {
                     $amount = $booking_price->amount_need_to_paid;
                     if($invoice->additional_charge > 0)
                     {
                         $amount = $amount + $invoice->additional_charge;
                     }
                 }
                 else{
                     $amount = $booking_price->initial_price;
                 }
                 
                 $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
                 $SuccessUrl = url('/')."/success-room"; 
                 $FailUrl = url('/')."/failed-rrom"; 
                 $requestParameter  = "$MerchantId|DOM|IN|INR|$amount|Other|$SuccessUrl|$FailUrl|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
                 $multi_parameter = "$amount|INR|GRPT";
                 $EncryptTrans = $this->encrypt($requestParameter,$key); 
                 $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key);
                //  $user->update(['payment_link'=>null]);
                // dd($booking_price->initial_price);
                 return view('Payment-link1', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls','user','booking_price','booking','invoice'));
        }
        else{ 
              return view('access-denied');
        } 
    }
    
    
    public function import(Request $request)
    {
        // Validate the uploaded file
        // $validator = Validator::make($request->all(), [
        //     'csv_file' => 'required|file|mimes:csv,txt',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        // dd($request->all());

        // Handle the uploaded file
        $file = $request->file('file');

        // Read the CSV file
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0); // Set the header offset
        // dd($csv);
        // Iterate through the CSV data
        foreach ($csv as $row) {
            // print_r($row);
              
            // Map CSV fields to the model
            $booking = new RoomBooking();
            $booking->booking_id =  $row['Booking ID']; // or other unique logic
            
            $checkinString = trim($row['Booking From']);
            $checkoutString = trim($row['Booking To']);
            $checkin_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkinString);
            $checkout_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkoutString);
        
            // Store the dates in the booking object in the desired format
            $booking->checkin_date = $checkin_date->format('Y-m-d');
            $booking->checkout_date = $checkout_date->format('Y-m-d');
            $booking->no_of_rooms = $row['NO OF ROOMS REQUIRED'];
            $booking->no_of_guests = 0; // Adjust as needed
            $booking->no_of_days = $row['Total No Of Days']; // Adjust as needed
            $booking->booking_count = $row['Total No Of Days']; // Adjust as needed
             echo $checkin_date;
              echo $checkout_date;
            $differenceInDays = $checkin_date->diffInDays($checkout_date);
            $user_data = User::where('userid',$row['Member ID'])->first();
            // print_r($user_data);
            // exit;
            if($user_data)
            { 
                $booking->user_id = $user_data->id;
                $booking->booked_by = $user_data->id;
                  
            }
            if($row['Check In Date'] != NULL)
            {
                $booking->actual_checkin_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row['Check In Date'])->format('Y-m-d'); 
                $booking->status = 1; // Adjust as needed
            }
            if($row['Check Out Date'] != NULL)
            {
                $booking->checkin_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row['Check Out Date'])->format('Y-m-d');
                $booking->status = 3; // Adjust as needed
            }
           if($row['_AppName'] != "Cancel Booking Request")
            { 
                $booking->status = 2; // Adjust as needed
            }
             $booking->member_id = $row['Member ID'];
             $booking->is_admin_approve = 1;
            $booking->save();
             $room_price_details = new \stdClass();
            
            $counts = 0;
            $per_day_price = 0;
            $per_day_price_guest = 0;
         $differenceInDays = $checkin_date->diffInDays($checkout_date);
            $starting_count = 1;
            for($i=1;$i<=$differenceInDays;$i++)
            {  
                for($k=1;$k<=$row['NO OF ROOMS REQUIRED'];$k++)
                { 
                    $room_price_details->pricing_details[$counts] =  new \stdClass(); 
                    $room_price_details->pricing_details[$counts]->days_count = $starting_count;
                    if($row['SELECT'] == "Guest"){
                        $room_price_details->pricing_details[$counts]->price = $row['Per Room Cost'];
                        $roombooking_price[$k]['price'] = $row['Per Room Cost'];
                        $roombooking_price[$k]['guest_type'] = "guest";

                    }else{
                        $room_price_details->pricing_details[$counts]->price = $row['Per Room Cost']; 
                        $roombooking_price[$k]['price'] = $row['Per Room Cost'];
                        $roombooking_price[$k]['guest_type'] =$row['SELECT'];
                    }
                    $room_price_details->pricing_details[$counts]->guest_type = $row['SELECT'];
                    // $starting_count++;
                    $counts++; 
                } 
                $starting_count++;

            } 
            $k=1;
               foreach($roombooking_price as $key=>$value)
            {
                // dd($value);
                $room_booking_guest = new RoomBookingGuest();  
                $room_booking_guest->booking_id = $row['Booking ID'];
                $room_booking_guest->room = $k;
                $room_booking_guest->per_day_price = $value['price'];
                $room_booking_guest->guest_type = $value['guest_type'];
                $room_booking_guest->save();
                $k++;
            }
            $booking_price= new RoomBookingPrice();
             $booking_price->booking_id = $row['Booking ID'];
            $booking_price->room_price_details =json_encode($room_price_details); 
            $booking_price->total_price = $row['TOTAL TARRIF'];
            $booking_price->amount_need_to_paid = $row['TOTAL TARRIF'];
            $booking_price->save();
             
            // Set other fields as necessary

  
          
        }

        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }

    
        /**
    * Get all vehicle types
    * @return \Illuminate\Http\JsonResponse
    */
    public function payment_link2(PartyBooking $booking,$payment_link)
    { 
     $get_booking_data = PartyBooking::where('id',$booking->id)->where('payment_link',$payment_link)->first();
     $user = User::find($booking->user_id); 
        if($get_booking_data)
        {   
           $invoice = new \stdClass();
                 $orderid = $booking->booking_id; 
                 $MerchantId = "1000356"; 
                 if($booking->status == 3)
                 {
                     $invoice = Invoice::where('booking_id',$booking->id)->first(); 
                     if($invoice->amount_need_to_paid > 0)
                     {
                         $amount = $invoice->amount_need_to_paid;
                     }
                     else{
                         $amount = $invoice->total_amount;
                     }
                      
                 }
                 else{
                     $amount = $booking->advance_amount;
                 }
                 
                 $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
                 $SuccessUrl = url('/')."/success-room"; 
                 $FailUrl = url('/')."/failed-rrom"; 
                 $requestParameter  = "$MerchantId|DOM|IN|INR|$amount|Other|$SuccessUrl|$FailUrl|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
                 $multi_parameter = "$amount|INR|GRPT";
                 $EncryptTrans = $this->encrypt($requestParameter,$key); 
                 $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key);
                //  $user->update(['payment_link'=>null]);
                // dd($booking_price->initial_price);
                 return view('Payment-link2', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls','user','booking','invoice'));
        }
        else{ 
              return view('access-denied');
        } 
    }
    // Function to encrypt the request string using AES encryption
    private function encryptSync($data, $key)
    {
        $method = 'AES-128-CBC'; // AES 256-bit CBC mode
        $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        
        // Encrypt the data
        $encrypted = openssl_encrypt($data, $method, base64_decode($key), OPENSSL_RAW_DATA, $iv);
        
        // Encode the encrypted data with base64
        $encryptedBase64 = base64_encode($iv . $encrypted);
        
        return $encryptedBase64;
    }
  public function test_form(){
      return view('form');
  }
   public  function encrypt($data,  $key)
        {
			 $algo='aes-128-cbc';
          
         $iv=substr($key, 0, 16);
                // echo $iv;
            $cipherText = openssl_encrypt(
                    $data,
                    $algo,
                    $key,
                    OPENSSL_RAW_DATA,
                    $iv
                );
        $cipherText = base64_encode($cipherText);
        
return $cipherText;
        
        
        }


public function decrypt($cipherText,  $key)
{
    $encryptedData = '9W90u1eH5CPyvE5o+xVmmQtVjBjDZhP2OmfTjViOPuKNWyjLDT7rCR71eoTK1kTB';

// Base64 decode the key and IV
$key = base64_decode('0Ddh1y3KXqaaUCJEe5sEOg==');
$iv = substr($key, 0, 16); // AES requires an IV of 16 bytes for AES-128-CBC

// Decrypt the data
$decryptedData = openssl_decrypt(base64_decode($encryptedData), 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
echo $decryptedData."------------";
if ($decryptedData === false) {
    echo "Decryption failed: " . openssl_error_string();
} else {
    echo "Decrypted data: " . $decryptedData;
}  
exit;
	 $algo='aes-128-cbc';

	 $iv=substr($key, 0, 16);
                // echo $iv;
	$cipherText = base64_decode($cipherText);
					
					$plaintext = openssl_decrypt(
                    $cipherText,
                    $algo,
                    $key,
                    OPENSSL_RAW_DATA,
                    $iv
                );
     return $plaintext;   

}   
  public function doubleVerification($merchant_order_no, $merchantid)
{
    $amount = 100; 
    $url="https://test.sbiepay.sbi/payagg/statusQuery/getStatusQuery"; // Test environment URL
    
    // Correcting the queryRequest format (no spaces)
    $queryRequest = "|$merchantid|$merchant_order_no|$amount";
    echo $queryRequest;
    // Building the post fields
    $queryRequest33 = http_build_query(array(
        'queryRequest' => $queryRequest,
        "aggregatorId" => "SBIEPAY",
        "merchantId" => $merchantid
    ));
    
    // Initializing cURL
    // $ch = curl_init($url);
    
    // // Setting cURL options
    // curl_setopt($ch, CURLOPT_SSLVERSION, true);  // Force TLS 1.2
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $queryRequest33);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    // // Force HTTP/1.1 to avoid HTTP/0.9 errors
    // // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$ch = curl_init($url);
    // // Set common headers
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //     'Content-Type: application/x-www-form-urlencoded',
    //     'Accept: application/json'
    // ));
    
    // Enabling verbose mode for detailed debugging
    // curl_setopt($ch, CURLOPT_VERBOSE, true);

    // Debugging: enable output of the request headers sent
    // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    
    // Executing cURL request
    
    
    curl_setopt($ch, CURLOPT_SSLVERSION, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    $response = curl_exec ($ch);
    // $response = curl_exec($ch);
    
    // Handling errors
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo "cURL Error: " . $error_msg;
    } else {
        // Get and display the request headers that were sent
        // $info = curl_getinfo($ch); 
        // echo "Request Headers: " . $info['request_header'];
        print_r($response);
        exit;
    }
    
    // Closing cURL connection
    curl_close($ch);
    
    // Returning or processing the response
    return $response;
}



    public function get_decryption_data(){
        for ($i=0; $i<10; $i++)
        {
		$d=rand(1,30)%2;
		$d=$d ? chr(rand(65,90)) : chr(rand(48,57));
		$orderid=$d;
        }
        $data='1000356|DOM|IN|INR|100|Other|https://iasmess.dubudubutechnologies.com/success|https://iasmess.dubudubutechnologies.com/failure|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE';
        $key='MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=';
        $cipherText = $this->encrypt($data,$key);  
         echo "ciphettext in SBIePAY enc dec is as below IS-----------".$cipherText;
        
        //$cipherText contains encrypted data
        //Calling decrypt method
        $plaintext = $this->decrypt($cipherText,$key);
        
        //Display decrypted text
        echo "plaintext  in SBIePAY enc dec is as below  IS-----------".$plaintext;
        
    }
    public function sbi(){
        // $requestParameter  = "|1000356|OD34395DHEN442CO4|75346|https://iasmess.dubudubutechnologies.com/success";
        // echo $requestParameter;
         $requestParameter  = "6566618919412|1000356|OD34395DHEN442CO4|100|https://iasmess.dubudubutechnologies.com/success";
         echo $requestParameter;
         $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
         $EncryptTrans = $this->encrypt($requestParameter,$key); 
         $MerchantId = "1000356"; 
        //  return view('sbi1', compact('EncryptTrans', 'MerchantId')); 
        $orderid = "OD" . rand(10000, 90000);
      for ($i=0; $i<10; $i++)
        {
		$d=rand(1,30)%2;
		$d=$d ? chr(rand(65,90)) : chr(rand(48,57));
		$orderid=$orderid.$d;
        }
        // dd($orderid);

        $MerchantId = "1000356"; 
        $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
        $SuccessUrl = "https://iasmess.dubudubutechnologies.com/success"; 
        $FailUrl = "https://iasmess.dubudubutechnologies.com/failure"; 
        //requestparameter 
        $requestParameter  = "1000356|DOM|IN|INR|100|Other|$SuccessUrl|$FailUrl|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
        $multi_parameter = "100|INR|GRPT";
        $EncryptTrans = $this->encrypt($requestParameter,$key); 
        echo '<b>Requestparameter:-</b> '.$requestParameter.'<br/><br/>';
        $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key);
        return view('sbi', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls'));
        //  return view('sbi', compact('EncryptTrans', 'MerchantId'));  
        
        
        
        
        // $requestParameter  ="1000356|DOM|IN|INR|100|Other|http://iasmess.dubudubutechnologies.com/success|http://iasmess.dubudubutechnologies.com/failure|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE"; 
        //  $requestParameter  ="1000356|DOM|IN|INR|100|Other|http://iasmess.dubudubutechnologies.com/success|http://iasmess.dubudubutechnologies.com/failure|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE"; 
        //  $requestParameter  ="1000356|DOM|IN|INR|100|Other|https://www.ukfdonline.com/sbipay/success.php|https://www.ukfdonline.com/sbipay/fail.php|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
        //  echo $requestParameter;
        //  exit;
        $EncryptTrans = $this->encrypt($requestParameter,$key); 
        // echo $EncryptTrans;
        // exit;
        $MultiAccountInstructionDtls="50|INR|GRPT||50|INR|AAT";
        $MultiAccountInstructionDtls=$this->encrypt($MultiAccountInstructionDtls,$key); 
       
       
      return view('sbi', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls')); 
        
    }
    
    public function index()
    { 
       
        
        // $apiKey = "Pte4eXLw90iLEGNTQqoPLQ";
        // $msisdn = '919566754418'; // Replace with the recipient's phone number
        // $sid = "DUBUAT";
        // $msg = "Dear User, Your IAS Mess account OTP is 123456.";
        // $fl = '0';
        // $gwid = '2';     
        // $response = Http::get('http://cloud.smsindiahub.in/vendorsms/pushsms.aspx', [
        // 'APIKey' => $apiKey,
        // 'msisdn' => $msisdn,
        // 'sid' => $sid,
        // 'msg' => $msg,
        // 'fl' => $fl,
        // 'gwid' => $gwid,
        // ]);

// Log the response for debugging purposes
// \Log::info('SMS API Response', ['response' => $response->body(), 'status' => $response->status(), 'headers' => $response->headers()]);
// dd("test");
// Dump the response to see the details
// dd($response->json());
        
        // Log the response for debugging purposes
        // \Log::info('SMS API Response', ['response' => $response->body(), 'status' => $response->status(), 'headers' => $response->headers()]);
        // // dd("test");
        // // Dump the response to see the details
        // dd($response->json());
 
// process_payment.php

// Function to encrypt data as per SBIePay encryption method


// Sanitize input data (in production, use proper validation and sanitization)
// $EncryptTrans = encryptData($_POST['EncryptTrans']);
// $EncryptbillingDetails = encryptData($_POST['EncryptbillingDetails']);
// $EncryptshippingDetails = encryptData($_POST['EncryptshippingDetails']);
// $EncryptpaymentDetails = encryptData($_POST['EncryptpaymentDetails']);
// $merchIdVal = $_POST['merchIdVal'];

// // Construct request to SBIePay endpoint
// $sbiepay_url = 'https://test.sbiepay.sbi/secure/AggregatorHostedListener';

// // Prepare data to be sent to SBIePay
// $post_data = array(
//     'EncryptTrans' => $EncryptTrans,F
//     'EncryptbillingDetails' => $EncryptbillingDetails,
//     'EncryptshippingDetails' => $EncryptshippingDetails,
//     'EncryptpaymentDetails' => $EncryptpaymentDetails,
//     'merchIdVal' => $merchIdVal
// );

// // Initialize cURL session
// $ch = curl_init();

// // Set cURL options
// curl_setopt($ch, CURLOPT_URL, $sbiepay_url);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // Execute cURL session
// $response = curl_exec($ch);

// // Check for cURL errors
// if(curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }

// // Close cURL session
// curl_close($ch);

// // Process response from SBIePay (handle success or failure)
// echo "Response from SBIePay:<br>";
// echo $response; // Display the response (you may want to process this further)
// exit;

//         $random_key = "LPAAS-GJLNV-ZSVIL-ZSWER";
//         $unique_id = uniqid('ref_', true);
//         $unique_host_device = substr(uniqid('device_', true), 0, 20);
//         $device_id = 'DEVICE123456789';
//         $mac_address = 'MAC123456';
//         $ip = $_SERVER['REMOTE_ADDR']; 
//         $mac_address = shell_exec('arp -a ' . escapeshellarg($ip)); 
//         // Usage example
//         $aadhaarNumber = "277279126294"; // Replace with the actual Aadhaar number
//         $transactionId = "1234567890"; // Replace with the actual transaction ID
//         $name = "Ranjith Kumar M"; // Replace with the actual name
//         $url = "https://tnpreauth.tn.gov.in/clientgwapi/api/Aadhaar/DoDemoAuth"; 
//         // // The parameters required by the API
//         $data = array(
//             "AUAKUAParameters" => array(
//                 "LAT" => "13.0843",
//                 "LONG" => "80.2705", 
//                 "DEVID" => $device_id, 
//                 "DEVMACID" => $mac_address, 
//                 "CONSENT" => "Y", 
//                 "SHRC" => "Y", 
//                 "VER" => "2.5",  
//                 "ENV" => "2",   
//                 "REF" => $unique_id,
//                 "RRN" => $transactionId,
//                 "SERTYPE" => "07",
//                 "SLK" => $random_key, 
//                 "UDC" => $unique_host_device,
//                 "UID" => $aadhaarNumber,
//                 "ISPA" => false, 
//                 "ISPFA" => false,
//                 "ISPI" => true,
//                 "PIMS"=> "E",
//                 "NAME" => $name
//             ),
//             "ENVIRONMENT" => 0,
//             "PIDXML" => ""
//         );

//     $data_string = json_encode($data);

//     $ch = curl_init($url);

//     // Set cURL options
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         'Content-Type: application/xml',
//         'Content-Length: ' . strlen($data_string))
//     );

//     // Execute cURL request and capture the response
//     $response = curl_exec($ch);
//     dd($response); 
//     if (curl_errno($ch)) {
//         $error_msg = curl_error($ch);
//         curl_close($ch);
//         return "cURL error: " . $error_msg;
//     }

//     // Close cURL session
//     curl_close($ch);
//     dd($response);
 
// dd($resp);
// exit; 
// dd("dsff");
        // $sender_id = 'KTSSSC';
        // $template_id = '1707168862643740857';
        // $phone = 8270512348;
        // $msg = "Your PSCK-FS Verification Code is 123456 valid for 5 Mins - KLABS";
        // $username = 'Indiaklabss5';
        // $apikey = '6F96A-CEFE5';
        // $uri = 'https://chatway.in/api/send-file';
        // // dd($phone);
        // // Construct the URL with query parameters
        // $url = $uri . '?' . http_build_query(array(
        //     'username' => $username,  
        //     'token' => 'Sk42QU00b1lLQ0RQcGxnbURKcVdJdz09',  
        //     'message' => $msg,
        //     'number' => $phone
        // ));
        // //    echo $url;
        // //    exit;
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
        //     echo $response;
        // }
        
        // // Close the cURL handle
        // curl_close($ch);
        // exit;
        return view('index'); 
    }
    public function payment_link(User $user,$payment_link,Request $request)
    { 
        $get_membership_data = UsersMembership::where('user_id',$user->id)->where('is_paid',0)->orderBy('created_at','DESC')->limit(1)->first();
        if($get_membership_data)
        {
            // dd($payment_link);
            $get_user_token_data = $this->user->where('payment_link',$payment_link)->where('id',$user->id)->first();
            if($get_user_token_data)
            {   
                 $orderid = "user-$user->id-" . rand(10000, 90000); 
                 $MerchantId = "1000356"; 
                 $amount = $get_membership_data->amount;
                 $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=";  
                 if($request->type)
                 {
                    $SuccessUrl = url('/')."/success";  
                    //  $SuccessUrl = url('/')."/success-renewal";  
                 }
                 else{
                     $SuccessUrl = url('/')."/success";  
                 }
                 $FailUrl = url('/')."/failure"; 
                 $requestParameter  = "$MerchantId|DOM|IN|INR|$amount|Other|$SuccessUrl|$FailUrl|SBIEPAY|$orderid|2|NB|ONLINE|ONLINE";
                 $multi_parameter = "$amount|INR|GRPT";
                //  echo $requestParameter;
                 $EncryptTrans = $this->encrypt($requestParameter,$key); 
                 $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key);  
                 return view('Payment-link', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls','user','get_membership_data'));
            }
            else{ 
                  return view('access-denied');
            }
             
        }
        else{
             return view('access-denied');
        }
        
    }
    public function payment_link3(Request $request)
    { 
        $data = $request->data; 
        $decrypt_data = json_decode(base64_decode($data));  
        $amount = $decrypt_data->total_amount;  
        $user = User::find(auth()->user()->user_id);
        if($amount)
        {   
                 $MerchantId = "1000356";  
                 $key = "MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg="; 
                 $SuccessUrl = url('/')."/success-room"; 
                 $FailUrl = url('/')."/failed-rrom"; 
                 $requestParameter  = "$MerchantId|DOM|IN|INR|$amount|Other|$SuccessUrl|$FailUrl|SBIEPAY|$data|2|NB|ONLINE|ONLINE";
                 $multi_parameter = "$amount|INR|GRPT";
                 $EncryptTrans = $this->encrypt($requestParameter,$key); 
                 $MultiAccountInstructionDtls=$this->encrypt($multi_parameter, $key); 
                 return view('Payment-link3', compact('EncryptTrans', 'MerchantId','MultiAccountInstructionDtls','user'));
        }
        else{ 
              return view('access-denied');
        } 
    }
    public function register()
    {
        $membership_tariff = MembershipTariff::get(); 
        return view('admin.register',compact('membership_tariff')); 
    }
    public function forget_user()
    {
        return view('admin.forget-userid'); 
    }
    public function forget_password()
    {
        return view('admin.forget-password'); 
    }
    public function register_confirmation()
    {
        return view('admin.register-confirmation'); 

    }
    public function reset_password($token)
    {
        $check_data_expires = new \stdClass();
        $check_data_expires = User::where('email_confirmation_token',$token)->first();  
    //dd($check_data_expires);
        if(!$check_data_expires)
        {
            redirect('/login');
        }
        else{ 
            if($check_data_expires->id){
                Session::put('resend_user_id',$check_data_expires->id); 
            }
            
            User::where('id',$check_data_expires->id)->update(['email_confirmation_token'=>NULL]);
        }
        return view('admin.verify-otp',compact('check_data_expires')); 
    }

    public function test()
    {  
         $this->decrypt('OD34395DHEN442CO4',1000356);
        //  $this->doubleVerification('OD34395DHEN442CO4',1000356);
         
    //      $message1="IAS+Officers%27+Mess%3A+Glad+to+inform+that+a+room+has+been+reserved+to+the+request.+Thanks+for+using+the+service.+If+any+clarification+please+contact+Ph%3A+044-25366920%2F25366924+-+TNPROT";
    //     $response = $this->smsContract->whatsappsend(9566754418, $message1); // Changed from $input to $mobile
    //     dd($response);
    //     $data = $this->smsContract->send1(9566754418,'IAS Mess: Thanks for using the service, Your request has been received and registered, Soon we will be processed  - TNPROT',1007015983312606440);
        
    //   dd($data);
        return view('admin.test');
    }
    public function register_user(Request $request)
    {
    $email = $request->email;
    $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('email', $email)->exists();

    if ($validate_exists_email) {  
        $user = $this->user->belongsTorole(Role::USER)->where('email', $email)->first(); 
        return $this->authenticateAndRespond($user, $request, $needsToken=true); 
        $this->throwCustomException('Provided mobile has already been taken');
    }
    
    $profile_picture = null;
    $proof = null;

    if ($uploadedFile = $this->getValidatedUpload('imageUpload', $request)) {
        $profile_picture = $this->imageUploader->file($uploadedFile)->saveProfilePicture();
    }
    if ($uploadedFile = $this->getValidatedUpload('proof', $request)) {
        $proof = $this->imageUploader->file($uploadedFile)->saveProfilePicture();
    }
    
    $userid = $this->user->belongsTorole(Role::USER)->orderBy('created_at', 'DESC')->pluck('userid')->first();

    if ($userid) {
        // Extract the numeric part from the userid
        preg_match('/(\d+)$/', $userid, $matches);
        $numberPart = isset($matches[1]) ? intval($matches[1]) + 1 : 5001; // Increment or default to 5001 if not found
        $userid = "TNIOM" . str_pad($numberPart, 4, '0', STR_PAD_LEFT); // Ensure the number part is at least 4 digits
    } else {
        $userid = "TNIOM5001"; // Default userid
    }

    $password = bcrypt($request->input('phone'));
    $user_params = [ 
        'salutation' => $request->input('salutation'),
        'name' => $request->input('full_name'), 
        'batch' => $request->input('batch'),
        'email' => $request->input('email'),
        'mobile' => $request->input('phone'),
        'address' => $request->input('address'),
        'date_joining' => $request->input('date_of_join'),
        'dob' => $request->input('dob'),
        'retired_date' => $request->input('date_of_retire'), 
        'membership_type' => $request->input('membership_type'),
        'profile_picture' => $profile_picture,
        'password' => $password,
        'raw_p' => $request->input('phone'),
        'proof' => $proof,
        'userid' => $userid
    ];

    $get_membership_tariff = MembershipTariff::find($request->input('membership_type'));
    $user = $this->user->create($user_params);

    $member_ship_data = new UsersMembership();
    $member_ship_data->user_id = $user->id;
    $member_ship_data->membership_type = $request->input('membership_type');
    $member_ship_data->date = Carbon::now('Asia/Kolkata')->format("Y-m-d H:i:s");
    $member_ship_data->amount = $get_membership_tariff->price;
    $member_ship_data->expiry_date = Carbon::now('Asia/Kolkata')->addYears(3)->format("Y-m-d H:i:s");
    $member_ship_data->is_lifetime_member = $get_membership_tariff->membership_type;
    $member_ship_data->is_paid = 0;
    $member_ship_data->save(); 
    $user->attachRole(Role::USER);

    // Prepare SMS messages
    $phoneNumber = $user->mobile; // Assuming 'mobile' is the column name for phone number
    
   

    // Second message
    $message2 = "IAS Officers' Mess: Dear {$user->name}, You have successfully submitted the membership registration form. Your membership registration id {$user->userid}. -TNPROT";
    $apiId2 = 1007833553441484189;

    // Send both SMS messages 
    
    $this->smsContract->send1($phoneNumber, $message2, $apiId2);
    $message1="IAS+Officers%27+Mess%3A+Dear+".$user->name."%2C+You+have+successfully+submitted+the+membership+registration+form.+Your+membership+registration+id+".$user->userid.".+-TNPROT";
    $response = $this->smsContract->whatsappsend($phoneNumber, $message1); // Changed from $input to $mobile
    
    

    return redirect('/register-confirmation'); 
}

    public function send_email(Request $request)
    { 
        $phone = $request->email;
        $validate_exists_email = $this->user->belongsTorole(Role::USER)->where('mobile', $phone)->first();

        if ($validate_exists_email) { 
            $response = [
                "status"=>false,
                "message"=>"Mobile No does not exists"
            ];
            $details = [
                'title' => "Mail from IAS Officers' Mess",
                'user_details' => $validate_exists_email,
                'type' => 'send_email'
            ];
            
            // Mail::to($request->email)->send(new UserNotification($details)); 
            $response = [
                "status"=>true,
                "message"=>"Email exists"
            ]; 
            $phoneNumber = $validate_exists_email->mobile; 
            $message1 = "IAS Mess: Sir/Madam, Welcome to IAS Officers' Mess online reservation system. Username: {$validate_exists_email->userid}, Password: {$validate_exists_email->mobile}, (For security reasons, change your password) Refer Your registered e-mail for further details - TNPROT";
            $apiId1 = 1007571722294400025;
            $this->smsContract->send1($phoneNumber, $message1, $apiId1); 
        }
        else{
            $response = [
                "status"=>false,
                "message"=>"Email does not exists"
            ];
        }
        return response()->json($response);
       
    }
    public function resend_forget_email(Request $request)
    {  
        $id = $request->id;
        $validate_exists_email = $this->user->where('id', $id)->first(); 
        // dd($validate_exists_email);
        if ($validate_exists_email) { 
            $email = $validate_exists_email->email;
            $response = [
                "status"=>false,
                "message"=>"Mobile number not registered. Please verify or register to proceed"
            ];
            $details = [
                'title' => 'Mail from Laravel App',
                'body' => 'This is a test email sent from a Laravel application.'
            ]; 

            $mobile = $validate_exists_email->mobile;
            
            $mobile_otp = MobileOtp::where('mobile', $mobile)->first();
    
            if (!$mobile_otp) {
                $otp = mt_rand(100000, 999999);
                if ($mobile == 9639639639 || $mobile == 9876543210) {
                    $otp = 123456; // Consider removing fixed OTPs in production.
                }
                Log::info($otp);
    
                $mobile_otp_table = new MobileOtp();
                $mobile_otp_table->mobile = $mobile; 
            
            } else {
                $otp = mt_rand(100000, 999999);
                if ($mobile == 9639639639 || $mobile == 9876543210) {
                    $otp = 123456; // Consider removing fixed OTPs in production.
                }
                Log::info($otp);
    
                $mobile_otp_table = MobileOtp::find($mobile_otp->id);
            }
            $mobile_otp_table->otp = $otp; 
            $mobile_otp_table->verified = false; 
            $mobile_otp_table->save();
            
            // Send SMS
            if ($mobile_otp_table) {
                // dd($mobile);
                $sender_id = 'KTSSSC';
                $template_id = '1707168862643740857';
                $phone = $mobile;
                // $otp = mt_rand(100000, 999999);
                $msg = "Your PSCK-FS Verification Code is ".$otp." valid for 5 Mins - KLABS";
                $username = 'Indiaklabss';
                $apikey = '6F96A-CEFE5';
                $uri = 'https://powerstext.in/sms-panel/api/http/index.php';
                    $data = array(
                    'username'=> $username,
                    'apikey'=> $apikey,
                    'apirequest'=>'Text',
                    'sender'=> $sender_id,
                    'route'=>'TRANS',
                    'format'=>'JSON',
                    'message'=> $msg,
                    'mobile'=> $phone,
                    'TemplateID' => $template_id,
                    );

                    $ch = curl_init($uri);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FAILONERROR, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
                    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
                    $resp = curl_exec($ch);
                    $error = curl_error($ch);
                    curl_close ($ch);
                    // echo json_encode(compact('resp', 'error'));
    
               
                // Log the response for debugging purposes
            
                // dd("test");
                // Dump the response to see the details
                // dd($response->json());
                // Handle response and potential errors from SMS API here.
            }
            $token = Str::random(40);
            $this->user->where('email', $email)->update(['email_confirmation_token'=>$token]);
            // dd($token);
            // Mail::to('ranjith@dubudubu.in')->send(new UserNotification($details));
            // dd($validate_exists_email);
            // dispatch(new UserNotification($validate_exists_email));
            $response = [
                "status"=>true,
                "message"=>"Email exists",
                "token"=>$token,
                "data"=>$validate_exists_email
            ];
        }
        else{
            $response = [
                "status"=>false,
                "message"=>"Email does not exists"
            ];
        }
        return response()->json($response);
    }
    public function send_forget_email(Request $request)
    {
    $mobile = $request->email;  // Assuming 'mobile' is sent in the request 
    $user = DB::table('users')
        ->where('mobile', $mobile) 
        ->first();  
    if ($user) {
        $email = $user->email;
        $mobile = $user->mobile;
    
        // Generate a 6-digit OTP
        $otp = random_int(100000, 999999);
    
        // Check if the mobile number already exists in the mobile_otp_verifications table
        $existingOtp = DB::table('mobile_otp_verifications')
            ->where('mobile', $mobile)
            ->first();
    
        if ($existingOtp) {
            // Update the existing record with the new OTP
            DB::table('mobile_otp_verifications')
                ->where('mobile', $mobile)
                ->update([
                    'otp' => $otp,
                    'verified' => 0, // Reset to not verified
                    'updated_at' => now(),
                ]);
        } else {
            // Insert a new record if it doesn't exist
            DB::table('mobile_otp_verifications')->insert([
                'mobile' => $mobile,
                'email' => $email,
                'otp' => $otp,
                'verified' => 0, // Initially set to 0 (not verified)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        // Send OTP via SMS (assuming you have an SMS service configured)
        
        
        $message = "State Guest House: Dear User, OTP to login to your State Guest House Portal is {$otp}. Do not share it with anyone - TNPROT";
        $response = $this->smsContract->send1($mobile, $message, 1007485887609012753); // Changed from $input to $mobile
       
    
        // Generate an email confirmation token
        $token = Str::random(40);
        DB::table('users')->where('id', $user->id)->update(['email_confirmation_token' => $token]);
    
        return response()->json([
            "status" => true,
            "message" => "Email exists",
            "token" => $token
        ]);
    
        } else {
            // Return an error response if the user is not found or doesn't have the specified name
            return response()->json([
                "status" => false,
                "message" => "Mobile number not registered with the required name. Please verify or register to proceed",
            ]);
        }
    }
     /**
     * Validate the mobile number verification OTP during registration.
     * @bodyParam otp string required Provided otp
     * @bodyParam uuid uuid required uuid comes from sen otp api response
     *
     * @param \App\Http\Requests\Auth\Registration\ValidateRegistrationOTPRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @response {"success":true,"message":"success"}
     */
public function validateMobileOTP(Request $request)
{
    // dd($request->all());
    $inputValuesArray = array_filter(explode(',', $request->inputValues), fn($value) => $value !== '');
    $otp = "";
    foreach($inputValuesArray as $k => $v)
    {
        $otp .= $v;
    }
    
    $user = User::find($request->id);
    $mobile = $user->mobile;
        $email = $user->email;
    // dd($user);
    // Directly validate the OTP from the mobile_otp_verifications table
    $mobile = $user->mobile;  // Assuming the mobile number is passed in the request
    // dd($mobile);
    // Check if the OTP exists for the mobile number in the mobile_otp_verifications table
    $verify_otp = DB::table('mobile_otp_verifications')
                    ->where('mobile', $mobile)
                    ->where('otp', $otp)
                    ->first();
                    
                    // dd($verify_otp);

    // If OTP verification fails
    if (!$verify_otp) 
    {
        return response()->json([
            "status" => false,
            "message" => "OTP is Invalid"
        ]);
    }

    // Mark the OTP as verified
    DB::table('mobile_otp_verifications')
        ->where('mobile', $mobile)
        ->where('otp', $otp)
        ->update(['verified' => true]);

    // Generate a token if needed, or proceed with the next step
    $token = Str::random(40);
     $this->user->where('email', $email)->update(['reset_token'=>$token]);
    // Return success response
    $response = [
        "status" => true,
        "message" => "OTP is Valid",
        "token" => $token,
    ];

    return response()->json($response);
}


    public function check_user_exists(Request $request)
    {
        // dd($request->all()); 
        $email = $request->email;
        $mobile = $request->mobile;
        $validate_exists_mobile = $this->user->belongsTorole(Role::USER)->where('mobile', $mobile)->orwhere('email', $email)->exists(); 
        if($validate_exists_mobile) { 
            $message = [
            "status"=>false,
            "message"=>"Email address or Mobile No. already Exists"
            ];
        } 
        else{
            $message = [
                "status"=>true
              ];
        }
        return response()->json($message);
    }
    public function get_user_details(Request $request)
    {
       $get_user_data = User::where('id',$request->data)->first();
       $message = [
        "status"=>true,
        "user"=>$get_user_data
        ];
        return response()->json($message); 
    }
    public function success(Request $request){ 
        $response = $request->encData; 
        $key='MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=';
        $decypted_data = $this->decrypt($response,$key);
        // dd("ssdfdfsdf");
        $values = explode('|', $decypted_data);
        $user_data = $values[0];
        $data = explode('-', $user_data);
        $payment_id = $values[1];
        $status = $values[2];
        $sbi_id = $values[13]; 
        if($sbi_id == 1000356)
        { 
            $new_membership_data = UsersMembership::where('user_id',$data[1])->where('is_paid',0)->orderBy('id','desc')->first(); 
            if($status == "SUCCESS")
            { 
                $user_data = User::find($data[1]);
                $user_data->is_approve = 1;
                $user_data->is_deleted = false;
                $user_data->is_payment_done = 1;
                $user_data->save();
                $new_membership_data->is_paid = 1;
                $new_membership_data->payment_mode = 1;
                $new_membership_data->expiry_date = Carbon::now('Asia/Kolkata')->addYear()->format("Y-m-d H:i:s");
                $new_membership_data->payment_id = $payment_id;
                $new_membership_data->save();
                return view('Payment-success', compact('new_membership_data','user_data')); 
            }
            elseif($status == "FAIL")
            { 
                return view('Payment-failure', compact('new_membership_data','user_data'));  
            }
            else{
                
            }
            
        }
        
      
        // dd($new_membership_data); 
        // $this->doubleVerification('OD34395DHEN442CO4',1000356);
        // dd($decypted_data);
        
    }
    
    
       public function success1(Request $request){ 
        $response = $request->encData; 
        $key='MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=';
        $decypted_data = $this->decrypt($response,$key);
        // dd("ssdfdfsdf");
        $values = explode('|', $decypted_data);
        $user_data = $values[0];
        $data = explode('-', $user_data);
        $payment_id = $values[1];
        $status = $values[2];
        $sbi_id = $values[13]; 
        if($sbi_id == 1000356)
        { 
            $datas = RoomBooking::where('id',$user_data)->first(); 
            $room_booking_price = RoomBookingPrice::where('booking_id',$user_data)->first();
            if($status == "SUCCESS")
            { 
                if($datas->status == 3)
                {
                    $datas->is_paid = 1; 
                    $datas->save(); 
                }
                else{
                    $room_booking_price->advance_amount_paid = 1; 
                    $room_booking_price->save(); 
                }
             
                return view('Payment-success', compact('room_booking_price','user_data')); 
            }
            elseif($status == "FAIL")
            { 
                return view('Payment-failure', compact('room_booking_price','user_data'));  
            }
            else{ 
                
            }
            
        } 
        
    }


    public function success2(Request $request){ 
        $response = $request->encData; 
        $key='MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=';
        $decypted_data = $this->decrypt($response,$key);
        // dd("ssdfdfsdf");
        $values = explode('|', $decypted_data);
        $user_data = $values[0];
        $data = explode('-', $user_data);
        $payment_id = $values[1];
        $status = $values[2];
        $sbi_id = $values[13]; 
        if($sbi_id == 1000356)
        { 
            $datas = PartyBooking::where('id',$user_data)->first();  
            $invoice = Invoice::where('booking_id',$user_data)->first(); 
            if($status == "SUCCESS")
            { 
                if($datas->status == 3)
                {
                    $datas->is_paid = 1; 
                    $datas->save(); 
                }
                else{
                    $invoice->advance_amount_paid = 1; 
                    $invoice->save(); 
                } 
                return view('Payment-success', compact('datas','user_data','invoice')); 
            }
            elseif($status == "FAIL")
            { 
                return view('Payment-failure', compact('datas','user_data','invoice'));  
            }
            else{ 
                
            } 
        }  
    }
    
    
    
      public function failure(Request $request){
     $response = $request->encData; 
        $key='MBxNMjIUnjl6H6B6XPEuJCppBxt8lwX9F4rH2Jxhglg=';
        $decypted_data = $this->decrypt($response,$key);
        echo $decypted_data; 
        exit;
    }
    
} 