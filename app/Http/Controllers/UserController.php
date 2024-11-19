<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
   public function register(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed'
        ]);
        $user = user::create($data);
        if($user){
            return view('Login');
        }
   }

   public function login(Request $request){
    $credentials = $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
    if(Auth::attempt( $credentials )){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('Login');
    }
   }
   public function dashboardPage(){
    if(Auth::check()){
        return view('dashboard');
    }else{
        return redirect()->route('Login');
    }
   }
   public function innerPage(){
    if(Auth::check()){
        return view('inner');
    }else{
        return redirect()->route('Login');
    }
   }
   public function Logout(){
        Auth::logout();
        return view('login');
   }
}

