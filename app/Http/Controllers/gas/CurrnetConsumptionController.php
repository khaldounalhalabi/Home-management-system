<?php

namespace App\Http\Controllers\gas;

use App\Http\Controllers\Controller;
use App\Models\GasSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrnetConsumptionController extends Controller
{
    public function current_consumption()
    {

        try {

            $user_id = Auth::user()->id;
            $gas_sensor = GasSensor::where('user_id', $user_id)->first();
            return response()->json([
                'message' => 'data has been retrieved',
                'current consumption' => $gas_sensor->current_consumption,
                'status' => 200,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
