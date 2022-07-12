<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $rules = [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(["message" => "there is been an error", "error message" => $validator->errors()]);
            }
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $bills_query = Bill::query();
            if (!is_null($start_date)) {
                $bills_query->where('date', '>=', $start_date);
            }
            if (!is_null($end_date)) {
                $bills_query->where('date', '<=', $end_date);
            }
            $user_id = Auth::user()->id;
            $bills_query->where('user_id', '=', $user_id);
            $bills = $bills_query->orderBy('date', 'DESC')->get();

            return response()->json(['message' => 'done', $bills]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $user_id = Auth::user()->id;
            $bill = Bill::where('user_id', $user_id)
                ->where('id', $id);
            return response()->json(['message' => 'done', $bill]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
