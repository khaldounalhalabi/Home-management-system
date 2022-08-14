<?php

namespace App\Console\Commands;

use App\Models\Consumption;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class MigrateConsumption extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateConsumption:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate the current consumption colomun from sensors table to consumption per day colomun in consumption table';

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
        DB::statement(
            'insert into consumptions (user_id , consumption_per_day , cost , date)
            select user_id , current_consumption , current_consumption*40 , CURRENT_DATE
            from sensors;'
        );

        DB::update('update sensors set current_consumption = 0 ');

        DB::statement(
            'insert into water_consumptions (user_id , consumption_per_day , cost , date)
            select user_id , current_consumption , current_consumption*10 , CURRENT_DATE
            from water_sensors;'
        );

        DB::update('update water_sensors set current_consumption = 0 ');

        DB::statement(
            'insert into gas_consumptions (user_id , consumption_per_day , cost , date)
            select user_id , current_consumption , current_consumption*40 , CURRENT_DATE
            from gas_sensors;'
        );

        DB::update('update gas_sensors set current_consumption = 0 ');
    }
}
