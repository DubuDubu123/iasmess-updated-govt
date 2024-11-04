<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\Driver;
use App\Models\Request\RequestRating;

class FirebaseUpdatDriverStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'firbase:drivers_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Drivers TripCount and details in Firebase for Dispatcher';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
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
