<?php

namespace App\Http\Controllers\gas;

use App\Http\Controllers\Controller;
use App\Models\GasSensor;
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
        ];

        $validator = Validator::make($request->only('start_time', 'end_time') , $rules);

        if ($validator->failed()) {
            return response()->json([
                'message' => 'bad request',
                'error' => $validator->errors(),
                'status' => 400
            ]);
        }

        try {
            $user_id = Auth::user()->id;
            $gas_sensor = GasSensor::where('user_id', $user_id)->first();
            $gas_sensor->start_cut_time = $request->start_time;
            $gas_sensor->end_cut_time = $request->end_time;
            $gas_sensor->save();

            return response()->json([
                'message' => "success",
                'gas sensor' => $gas_sensor,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'there is been an error',
                'error' => $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
