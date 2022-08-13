<?php

namespace App\Http\Controllers\water;

use App\Http\Controllers\Controller;
use App\Models\WaterSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SetCutTimeController extends Controller
{
    public function set_cut_time(Request $request)
    {
        $rules = [
            'start_time' => 'date_format:h:m|required',
            'end_time' => 'date_format:h:m|required'
        ] ;

        $validator = Validator::make($request->only('start_time' , 'end_time') , $rules) ;

        if($validator->failed()){
            return response()->json([
                'message' => 'bad request' ,
                'error' => $validator->errors() ,
                'status' => 400
            ]) ;
        }

        try{
            $user_id = Auth::user()->id ;
            $water_sensor = WaterSensor::where('user_id' , $user_id)->first() ;
            $water_sensor->start_cut_time = $request->start_time ;
            $water_sensor->end_cut_time = $request->end_time ;
            $water_sensor->save() ;

            return response()->json([
                'message' => "success" ,
                'water sensor' => $water_sensor ,
                'status' => 200
            ]) ;
        }catch(\Exception $e){
            return response()->json([
                'message'=>'there is been an error' ,
                'error' => $e->getMessage() ,
                'status' => 500
            ]) ;
        }
    }
}
