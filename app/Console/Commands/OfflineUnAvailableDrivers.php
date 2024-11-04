<?php

namespace App\Console\Commands;

use App\Models\Admin\Driver;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\Notifications\SendPushNotification;
use Log;
use App\Models\Request\RequestCycles; 
use App\Models\Request\Request;
use App\Models\User;
use App\Models\Request\RequestMeta;
use App\Models\Request\DriverRejectedRequest;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers; 

class OfflineUnAvailableDrivers extends Command
{
    use FetchDriversFromFirebaseHelpers;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offline:drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offline Un Available Drivers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
    }
}
