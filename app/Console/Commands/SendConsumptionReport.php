<?php

namespace App\Console\Commands;

use App\Mail\SendReport;
use App\Models\Consumption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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

                $total_cost = 0;
                $total_consumption = 0;

                $consumption = Consumption::
                select('consumption_per_day' , 'cost')
                ->where('user_id' , $user->id)
                ->whereBetween(
                    'date',
                    [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
                )
                ->get()
                ->toArray();

                foreach ($consumption as $c) {
                    $total_cost+=$c['cost'] ;
                    $total_consumption += $c['consumption_per_day'] ;
                }

                Mail::to($user['email'])->send(new SendReport($total_consumption , $total_cost));
                return 1 ;
            }
        }
        catch(\Exception $e){
            return 0 ; 
        }
    }
}
