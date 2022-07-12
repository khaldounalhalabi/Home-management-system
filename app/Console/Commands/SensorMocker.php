<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class SensorMocker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SensorMocker:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'artisan command to mocke an electrical consumption sensor';

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
        DB::table('sensors')
        ->where('interrupter_status' , 1)
        ->increment('current_consumption', 1);
    }
}
