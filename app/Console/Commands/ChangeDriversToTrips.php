<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Request\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Jobs\NoDriverFoundNotifyJob;
use App\Jobs\SendRequestToNextDriversJob;
use Kreait\Firebase\Contract\Database;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers; 
use App\Models\Request\DriverRejectedRequest;
use App\Models\Request\RequestCycles; 
use App\Models\Admin\Driver;
use App\Models\User;

class ChangeDriversToTrips extends Command 
{
    use FetchDriversFromFirebaseHelpers;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:totrip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the request to other drivers when the driver doesn\'t respond';

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
