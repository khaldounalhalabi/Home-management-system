<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function over_consumption()
    {
        $user_id = Auth::user()->id ;
        $sensor = Sensor::where('user_id' , $user_id)->first() ;
        try{
            if($sensor->current_consumption >= $sensor->allowed_consumption){
                return response()->json([
                    'message' => 'over consumption' ,
                    'status' => 200
                ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'there is been an error' ,
                'error' => $e->getMessage()
            ]) ;
        }
    }


    public function over_consumption_cost()
    {
        $user_id = Auth::user()->id;
        $sensor = Sensor::where('user_id', $user_id)->first();
        try {
            if ($sensor->current_consumption*40 >= $sensor->allowed_consumption_cost){
                return response()->json([
                    'message' => 'over consumption cost',
                    'status' => 200
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'there is been an error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function over_consumption_peak()
    {
        $user_id = Auth::user()->id;
        $sensor = Sensor::where('user_id', $user_id)->first();
        try {
            if ($sensor->current_consumption >= 150 && $sensor->start_peak_time <= Carbon::now()->format('H:i') && $sensor->end_peak_time >= Carbon::now()->format('H:i') ) {
                return response()->json([
                    'message' => 'over consumption in peak time',
                    'status' => 200
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'there is been an error',
                'error' => $e->getMessage()
            ]);
        }
    }
}
