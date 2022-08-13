<?php

namespace App\Http\Controllers\gas;

use App\Http\Controllers\Controller;
use App\Models\GasSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetGasSensorController extends Controller
{
    public function get()
    {
        try {

            $user_id = Auth::user()->id;
            $gas_sensor = GasSensor::where('user_id', $user_id)->first();
            return response()->json([
                'message' => 'success',
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
