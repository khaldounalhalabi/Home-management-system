<?php

namespace App\Http\Controllers;

use App\Models\Interrupter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterrupterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $interrupters = Interrupter::where('user_id', $user_id)->get();
        // $time = Carbon::now('+03:00')->format('H:i:s');
        // dd($time) ;
        return response()->json(['message' => 'done', $interrupters]);
    }



    public function show($id)
    {
        try {
            $user_id = Auth::user()->id;
            $interrupter = Interrupter::where('user_id', $user_id)
                ->where('id', $id)->first();
            return response()->json(['message' => 'done', $interrupter]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', 'error message' => $e->getMessage()]);
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
        $request->validate([
            'room_device' => 'string|max:55',
        ]);
        $user_id = Auth::user()->id;
        $interrupter = new Interrupter;
        $interrupter->user_id = $user_id;
        $interrupter->room_device = $request->room_device;
        $interrupter->status = 0;
        $interrupter->save();
        return response()->json(['message' => 'done', $interrupter]);
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
        $request->validate([
            'room_device' => 'string|max:55',
        ]);
        $user_id = Auth::user()->id;

        $interrupter = Interrupter::where('user_id', $user_id)
            ->where('id', $id)->first();
        $interrupter->room_device = $request->room_device;
        $interrupter->save();
        return response()->json(['message' => 'done', $interrupter]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;

        $interrupter = Interrupter::where('user_id', $user_id)
            ->where('id', $id)->first();
        try {
            if($interrupter){
                $interrupter->delete();
                return response()->json(['message' => 'done']);
            }
            else{
                return response()->json(['message' => 'you are not authorized to delete this Interrupter']) ;
            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', 'error message' => $e->getMessage()]);
        }
    }

    public function on_of($id, Request $request)
    {
        try {
            $request->validate([
                'status' => 'boolean',
            ]);

            $user_id = Auth::user()->id;

            $interrupter = Interrupter::where('user_id', $user_id)
                ->where('id', $id)->first();

            if($interrupter){
                $interrupter->status = $request->status;
                $interrupter->save();
                return response()->json([
                    'message' => 'done',
                    'interrupter' => $interrupter ,
                ]);}
                else{
                    return response()->json([
                        'message'=>'you are not authorized to change the status of this interrupter'
                        ]) ;
                }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'there is been an error',
                'error message' => $e->getMessage()
            ]);
        }
    }
}
