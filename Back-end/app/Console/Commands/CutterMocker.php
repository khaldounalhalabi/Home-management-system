<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CutterMocker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CutterMocker:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cut the current if it the time to cut';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::statement(
            'update sensors
                   set interrupter_status = 0
                   where start_cut_time <= current_time()
                   and end_cut_time >= current_time()'
                   ) ;

        DB::statement(
            'update water_sensors
                   set status = 0
                   where start_cut_time <= current_time()
                   and end_cut_time >= current_time()'
        );

        DB::statement(
            'update gas_sensors
                   set status = 0
                   where start_cut_time <= current_time()
                   and end_cut_time >= current_time()'
        );
    }
}
