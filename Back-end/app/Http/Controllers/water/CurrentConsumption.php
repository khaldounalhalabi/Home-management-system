<?php

namespace App\Http\Controllers\water;

use App\Http\Controllers\Controller;
use App\Models\WaterSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentConsumption extends Controller
{
    public function current_consumption()
    {

        try{

            $user_id = Auth::user()->id;
            $water_sensor = WaterSensor::where('user_id', $user_id)->first();
            return response()->json([
                'message' => 'data has been retrieved' ,
                'current_consumption' => $water_sensor->current_consumption ,
                'status' => 200 ,

            ]) ;
        }
        catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage() ,
                'status' => 500
            ]) ;
        }


    }
}
