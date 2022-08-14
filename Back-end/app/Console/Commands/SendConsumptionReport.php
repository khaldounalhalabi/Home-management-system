<?php

namespace App\Console\Commands;

use App\Mail\SendReport;
use App\Models\Consumption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
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

        $client = new Http ;
        $res = $client->get('http://127.0.0.2/api');

        return $res ;
    }




}
