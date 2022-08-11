<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Events\OverConsumption; // import event class at the top of the file

class SensorController extends Controller
{
    public function set_allowed_consumption(Request $request)
    {

        $validated = $request->validate([
            'allowed_consumption' => 'required|numeric',
        ]);

        $user_id = Auth::user()->id;
        $sensor = Sensor::where('user_id', $user_id)->first();
        $sensor->allowed_consumption = $request->allowed_consumption;
        $sensor->save();
        return response()->json(['message' => 'done', 'sensor' => $sensor]);
    }


    public function set_allowed_consumption_coast(Request $request)
    {

        $validated = $request->validate([
            'allowed_consumption_cost' => 'required|numeric',
        ]);

        $user_id = Auth::user()->id;
        $sensor = Sensor::where('user_id', $user_id)->first();
        $sensor->allowed_consumption_cost = $request->allowed_consumption_cost;
        $sensor->save();
        return response()->json(['message' => 'done', 'sensor' => $sensor]);
    }

    public function sensor_status(Request  $request)
    {
        $validated = $request->validate([
            'status' => 'required|boolean'
        ]);
        $user_id = Auth::user()->id;
        $sensor = Sensor::where('user_id', $user_id)->first();
        $sensor->interrupter_status = $request->status;
        $sensor->save();
        return response()->json(['message' => 'done', 'sensor' => $sensor]);
    }


    public function set_cut_time(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'date_format:H:i:s|required',
                'end_time' => 'date_format:H:i:s|required'
            ]);

            $user_id = Auth::user()->id;
            $sensor = Sensor::where('user_id', $user_id)->first();
            $sensor->start_cut_time = $request->start_time;
            $sensor->end_cut_time = $request->end_time;
            $sensor->save();
            return response()->json(['message' => 'done', $sensor]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', $e->getMessage()]);
        }
    }

    public function set_peak_time(Request $request)
    {
        try {
            $request->validate([
                'start_peak_time' => 'date_format:H:i:s|required',
                'end_peak_time' => 'date_format:H:i:s|required',
            ]);

            $user_id = Auth::user()->id;
            $sensor = Sensor::where('user_id', $user_id)->first();
            $sensor->start_peak_time = $request->start_peak_time;
            $sensor->end_peak_time = $request->end_peak_time;
            $sensor->save();

            return response()->json(['message' => 'done', $sensor]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', $e->getMessage()]);
        }
    }


    public function get_current_consumption()
    {

        try{
            $user_id = Auth::user()->id ;
            $sensor = Sensor::where('user_id' , $user_id)->first() ;
            return response()->json([
                'message' => 'data has been retrieved successfuly' ,
                'current consumption' => $sensor->current_consumption ,
                'cost' => $sensor->current_consumption * 40
            ]) ;
        }

    catch(\Exception $e){
        return response()->json([
            'message' => 'there is been an error' ,
            'error' => $e->getMessage()
        ]) ;
    }


    }




//     public function show()
//     {
//         // $user_id = auth()->user()->id;
//         // $sensor = Sensor::where('user_id' , $user_id) ;
//         $sensor = Sensor::all()->first() ;
//         event(new OverConsumption($sensor)); // broadcast `ScoreUpdated` event

//         return redirect()->back()->withValue($sensor->current_consumption);
//     }


//     public function show_sensor()
//     {
//         return Sensor::all();
//     }

 }
