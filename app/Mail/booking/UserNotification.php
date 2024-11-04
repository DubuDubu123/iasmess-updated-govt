<?php

namespace App\Mail\booking; 

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

class UserNotification extends Mailable
{
    // use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        // dd($details);
        $this->details = $details;
        
          if($this->details['type'] == "confirm_email")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.user');
        }
        elseif($this->details['type'] == "send_cred")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_cred');
        }
        elseif($this->details['type'] == "send_payment_link")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_payment_link');
        }
        elseif($this->details['type'] == "send_payment_link1")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.booking.send_payment_link');
        }
        elseif($this->details['type'] == "membership")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.membership');
        }
        else{
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_email');
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->details['type'] == "confirm_email")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.user');
        }
        elseif($this->details['type'] == "send_cred")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_cred');
        }
        elseif($this->details['type'] == "send_payment_link")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_payment_link');
        }
        elseif($this->details['type'] == "send_payment_link1")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.booking.send_payment_link');
        }
        elseif($this->details['type'] == "membership")
        {
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.membership');
        }
        else{
            return $this->subject($this->details['title'])
            ->view('email.auth.registration.send_email');
        }
       
    }
}
