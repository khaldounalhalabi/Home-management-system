<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('SensorMocker:minute')->everyMinute();
        $schedule->command('CutterMocker:minute')->everyMinute();
        $schedule->command('MigrateConsumption:daily')->everyTwoMinutes(); //dailyAt('24:00');
        $schedule->command('SendConsumptionReport')->everyMinute()->thenPing('http://127.0.0.2/api/report'); //->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
