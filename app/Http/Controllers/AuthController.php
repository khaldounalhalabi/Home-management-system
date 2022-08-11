<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->only('email', 'password'), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        try {
            $credentials = $request->only('email', 'password');
            if (auth()->guard('web')->attempt($credentials)) {
                $token = auth()->user()->createToken('authToken')->accessToken ;
                //dd(auth()->user()) ;
                return response()->json([
                    'status' => 'success',
                    'token' => $token ,
                ]);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
                }
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', 'error message' => $e->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:55|min:3',
            'email' => 'string|email|max:100|required|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone_number' => 'nullable|digits:10',
            'home_number' => 'nullable|digits:7',
        ];
        $validator = Validator::make($request->only('name', 'password_confirmation', 'email', 'password', 'phone_number', 'home_number'), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = $user->createToken('AuthToken')->accessToken ;
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'Bearer',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is been an error', 'error message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    // public function refresh()
    // {
    //     return response()->json([
    //         'status' => 'success',
    //         'user' => Auth::user(),
    //         'authorisation' => [
    //             'token' => Auth::refresh(),
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

    public function user_details()
    {
        // $user['name'] = Auth::user()->name;
        // $user['email'] = Auth::user()->email;
        // $user['home_number'] = Auth::user()->home_number;
        // $user['phone_number'] = Auth::user()->phone_number;

        $user = User::where('id' , Auth::user()->id) ;

        return response()->json(['user' => $user]);
    }
}
