<?php

namespace App\Http\Controllers\API;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function signup(Request $request){
        $validateUser = Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required'
            ]
            );

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validateUser->errors()->all()
                ],401);
            }
            $user = user::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

                return response()->json([
                    'status' => True,
                    'message' => 'User Created Successfully',
                    'user' => $user,
                ],200);
    }
    public function login(Request $request){
        $validateUser = Validator::make(
            $request->all(),
            [
                'email'=>'required|email',
                'password'=>'required'
            ]
            );
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Authentication Fails',
                    'errors' => $validateUser->errors()->all()
                ],404);
            }
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $Authuser = Auth::user();
                return response()->json([
                    'status' => True,
                    'message' => 'User Logged in Successfully',
                    'token' => $Authuser->createToken('API Token')->plainTextToken,
                    'token_type' => 'bearer'
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not matched',
                ],401);
            }
    }
    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => True,
            'user' => $user,
            'message' => 'User Logged out Successfully',
        ],200);
    }
}
