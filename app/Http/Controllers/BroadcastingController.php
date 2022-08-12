<?php

namespace App\Http\Controllers;

use App\Events\ConsumptionEvent;
use App\Models\Consumption;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BroadcastingController extends Controller
{
    public function consumption_broadcast()
    {
        $user_id = Auth::user()->id ;
        $sensor = Sensor::where('user_id' , $user_id)->get() ;
        event(new ConsumptionEvent($user_id, $sensor));
        ConsumptionEvent::dispatch($user_id , $sensor) ;
        return 'ok' ;
    }
}
