<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment\DriverSubscription;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\NotifyViaMqtt;
use App\Base\Constants\Masters\PushEnums;
use Carbon\Carbon;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Admin\Notification;
use App\Jobs\UserDriverNotificationSaveJob;
use App\Models\Admin\UserDriverNotification;
use Log;
class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Expired Subscription';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    }
}


