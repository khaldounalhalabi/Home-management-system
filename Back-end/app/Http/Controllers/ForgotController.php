<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ForgotController extends Controller
{
    public function forgot(Request $request)
    {
        $rules =  [
            'email' => 'required|email' ,
        ];


        $validator = Validator::make($request->only( 'email'), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }


        $email = $request->email ;


        if(User::where('email' , $email)->doesntExist()){
            return response()->json(['message'=>'User is not exist']) ;
        }

       try{
        // $token = Str::random(10) ;

        // DB::table('password_resets')->insert([
        //     'email'=>$email ,
        //     'token'=>$token ,
        // ]) ;

            //Send Email
            $user = User::where('email' , $email)->get()->first() ;
            //dd($user) ;
            Mail::to($user->email)->send(new ResetPassword($user->name));
            return response()->json([
            'message' => 'Check Your Email'
        ]) ;
    }
    catch(\Exception $e){
        return response()->json([
            'message' => 'There is been an error' ,
            'error message' => $e->getMessage()
            ]) ;
        }
    }




}
