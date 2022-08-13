<?php

namespace App\Console\Commands;

use App\Models\Consumption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendConsumptionReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendConsumptionReport:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command send a consumption report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $users = User::all() ;
            foreach ($users as $user) {
                Consumption::
                select('consumption_per_day' , 'cost')
                ->whereBetween(
                    'date',
                    [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
                )
                ->get()
                ->toArray();
            }
        }
        catch(\Exception $e){
            return $e->getMessage() ;
        }
    }
}
