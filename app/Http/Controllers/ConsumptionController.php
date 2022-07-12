<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ConsumptionController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'start_date' => 'nullable|date_format:Y-m-d', //format : YYYY-MM-DD
            'end_date' => 'nullable|date_format:Y-m-d', //format : YYYY-MM-DD
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["message" => "there is been an error", "error message" => $validator->errors()]);
        }
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        try {
            $consumption_query = Consumption::query();
            if (!is_null($start_date)) {
                $consumption_query->where('date', '>=', $start_date);
            }
            if (!is_null($end_date)) {
                $consumption_query->where('date', '<=', $end_date);
            }
            $user_id = Auth::user()->id;
            $consumption_query->where('user_id', '=', $user_id);
            $consumption = $consumption_query->orderBy('date', 'DESC')->get();
            return response()->json([$consumption, 'message' => 'data has been retrieved']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', 'error message' => $e->getMessage()]);
        }
    }
}
