<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $rules = [
            'password' => 'required|string|confirmed',
        ];

        $validator = Validator::make($request->only('password') , $rules) ;
        if($validator->failed()){
            return response()->json([
                "message" => "Wrong Entries" ,
                "error" => $validator->errors() ,
            ]) ;
        }

        try{
            $user = User::where('email' , $request->email)->first() ;
            $user->password = bcrypt($request->password) ;
            $user->save() ;
            return response()->json([
                'message' => 'ok' ,
                'status' => 200 ,
                'user' => $user
            ]) ;
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'there is been an error' ,
                'error' => $e->getMessage()
            ]) ;
        }
    }
}
