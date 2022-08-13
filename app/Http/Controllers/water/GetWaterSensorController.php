<?php

namespace App\Http\Controllers\water;

use App\Http\Controllers\Controller;
use App\Models\WaterSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetWaterSensorController extends Controller
{
    public function get()
    {
        try{
            $user_id = Auth::user()->id ;
            $water_sensor = WaterSensor::where('user_id' , $user_id)->first() ;
            return response()->json([
                'message' => 'success' ,
                'water sensor' => $water_sensor ,
                'status' => 200
            ]) ;
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'there is been an error' ,
                'error' => $e->getMessage() ,
                'status' => 500
            ]) ;
        }
    }
}
