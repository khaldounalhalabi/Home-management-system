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
    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email') ;
        if(User::where('email' , $email)->doesntExist()){
            return response()->json(['message'=>'User is not exist']) ;
        }

       try{
        $token = Str::random(10) ;

        DB::table('password_resets')->insert([
            'email'=>$email ,
            'token'=>$token ,
        ]) ;

            //Send Email
            Mail::to($email)->send(new ResetPassword());
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


    public function reset(Request $request , $email)
    {
        $user = User::where('email' , $email)->get() ;

        $rules = [
            'password' => 'required|confirmed|min:6',
        ];

        $validator = Validator::make($request->only('password'), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        try{

            $user->password = bcrypt($request->password) ;
            $user->save() ;
            return response()->json([
                'message' => 'Your password has been changed'
            ]) ;
        }
        catch(\Exception  $e){
            return response()->json([
                'message' => 'there is been error' ,
                'error' => $e->getMessage() , 
            ]) ;
        }


    }

}
