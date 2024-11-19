
@extends('layout')
@section('title')
Register And Login    
@endsection
@section('head')
Register and login to access the website   
@endsection
@section('sub-head')
Login and registration page links   
@endsection
@section('content')

{{-- @if (session('status'))
<div class="status" style="color:white;font-size:20px;font-weight:bold;background:greenyellow;margin:10px;padding:16px;">
        {{session('status')}}
</div>
@endif --}}
     <div class="btns">
        <div class="Register">
            <a type="button" class="btn btn-primary" href="{{route('Register')}}">Register</a>
        </div>
        <div class="Login">
            <a type="button" class="btn btn-primary"  href="/loginpage">Login</a>
        </div>
     </div>  
@endsection

       