<?php
namespace App\Base\Libraries\SMS\Providers;

use App\Base\Libraries\SMS\Exceptions\SMSFailException;
use App\Base\Libraries\SMS\Exceptions\SMSInsufficientCreditsException;
use App\Base\Libraries\SMS\Exceptions\SMSMaxNumbersException;
use App\Base\Libraries\SMS\SMS;

class OnusAgura implements OnusAguraContract
{
    /** @var string */
    protected $apiUrl = 'https://tmegov.onex-aura.com/api/sms';

    /** @var string */
    protected $username;

    /** @var string */
    protected $password;

    /** @var string */
    protected $senderId;

    /**
     * SMSIndiaHub constructor.
     *
     * @param array $settings
     */
    public function __construct($settings)
    { 
        $this->key = data_get($settings, 'key');
        $this->entityid = data_get($settings, 'entity');
        $this->senderId = data_get($settings, 'sender_id'); 
        // $this->apiUrl = $apiUrl; 
    }

    /**
     * Send the SMS.
     *
     * @param array $numbers
     * @param string $message
     * @param int $type
     * @return bool
     * @throws SMSFailException
     * @throws SMSInsufficientCreditsException
     */
    public function sendsms($number, $message, $template_id)
    { 
        // dd(array(
        //     'key' => $this->key,  
        //     'to' => $number[0],
        //     'from' => $this->senderId,
        //     'body' => $message,
        //     'entityid' => $this->entityid,   
        //     'templateid' => $template_id,
        // ));
        $url = $this->apiUrl . '?' . http_build_query(array(
            'key' => $this->key,  
            'to' => $number[0],
            'from' => $this->senderId,
            'body' => $message,
            'entityid' => $this->entityid,   
            'templateid' => $template_id,
        ));
        
        // echo $url;
        // exit;
        
        $ch = curl_init();
        
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Set the HTTP method to GET (since we're sending data in the URL)
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        
        // Set CURLOPT_RETURNTRANSFER so that curl_exec returns the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $results = curl_exec($ch);
        // dd($response1);
        // Check for errors
        if(curl_errno($ch)) {
            // echo 'Curl error: ' . curl_error($ch);
            $response = [
                'status' => false,
                'message' => curl_error($ch)
            ];
            // return response()->json($response);
        } else { 
            $response = [
                'status' => true,
                'data'=>$results
            ];
        }  
        // Close the cURL handle
        curl_close($ch);

        return $response;

    }
    public function whatsappsend($number, $message)
    {    
         $url = env('WHATSAPP_API_URL') . '?userid=' . env('WHATSAPP_USER_ID') . '&password=' . env('WHATSAPP_SECURITY_KEY') . '&send_to=' . $number . '&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=' . $message;
        
        // echo $url;
        // exit;
        
        $ch = curl_init();
        
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Set the HTTP method to GET (since we're sending data in the URL)
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        
        // Set CURLOPT_RETURNTRANSFER so that curl_exec returns the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $results = curl_exec($ch);
        // dd($response1);
        // Check for errors
        if(curl_errno($ch)) {
            // echo 'Curl error: ' . curl_error($ch);
            $response = [
                'status' => false,
                'message' => curl_error($ch)
            ];
            // return response()->json($response);
        } else { 
            $response = [
                'status' => true,
                'data'=>$results
            ];
        }  
        // Close the cURL handle
        curl_close($ch);

        return $response;

    }


 
}
