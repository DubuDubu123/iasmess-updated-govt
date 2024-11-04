<?php

namespace App\Jobs;

use App\Models\RoomBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class SendWhatsAppReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RoomBooking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Test WhatsApp message sending logic here
        $message_re = "Dear+Bala%2C%0AThis+is+a+test+reminder+for+your+upcoming+check-in+for+booking+".$this->booking->id."+at+IAS+Officers+Mess.+Check-in+on+".$this->booking->checkin_date.".";

        // Assuming smsContract is set up properly to send WhatsApp messages
        $this->smsContract->whatsappsend(8056496398, $message_re);
    }
}
