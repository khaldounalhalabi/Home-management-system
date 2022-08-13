<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolarController extends Controller
{
    public function solar()
    {

        try{
            $total = 0 ;
            $user_id = Auth::user()->id ;
            $consumption = Consumption::where('user_id' , $user_id)->get()->toArray() ;
            $count = count($consumption) ;
            foreach ($consumption as $c) {
                $total += $c['consumption_per_day'] ;
            }
            $average = $total/$count ;

            if($average < 21.1){
                return response()->json([
                    'data' => '9-12' ,
                    'status' => 200
                ]) ;
            }

            if($average == 21.1){
                return response()->json([
                    'data' => '14-17' ,
                    'status' => 200
                ]) ;
            }

            if($average > 21.1 && $average<33){
                return response()->json([
                    'data' => '16 - 19' ,
                    'status' => 200
                ]) ;
            }

            if ($average == 33) {
                return response()->json([
                    'data' => '19-25',
                    'status' => 200
                ]);
            }
            if ($average > 33 && $average < 39) {
                return response()->json([
                    'data' => '27 - 32',
                    'status' => 200
                ]);
            }

            if ($average > 39 && $average < 47) {
                return response()->json([
                    'data' => '35 - 40',
                    'status' => 200
                ]);
            }


        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage() ,
                'status' => 500
            ]) ;
        }

    }
}
