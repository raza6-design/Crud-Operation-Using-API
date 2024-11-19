
@extends('layout')
@section('title')
    Register user
@endsection
@section('head')
     User Registration Form
@endsection
@section('sub-head')
     Fill The Bellow Form To Register
@endsection
@section('content')
    <style>
               button{
            padding: 10px;
            border: 2px white;
            border-radius: 16px;
            width: 14%;
            background: #024f66;
            color: white;
            font: 900;
            font-weight: bolder;
            margin-top: 16px;
            font-size: 22px;
            margin-left: 45px;
        }
        .button {
            margin-top: 20px;
        }
        .button a{
            padding: 10px;
            border: 2px white;
            border-radius: 16px;
            width: 14%;
            background: #000608;
            color: white;
            font: 900;
            font-weight: bolder;
            margin-top: 16px;
            font-size: 22px;
            margin-left: 45px;
        }
    </style>
    <div class="form">
        <form class="myform"  action="{{route('registersave')}}" method="POST" >
            @csrf
            {{-- @method('PUT') --}}
            <label for="name">Name</label>
            <input type="text" value="" name="name" id="name">
            @error('name')
                {{$message}}
            @enderror
             <br>
            <label for="email">Email</label>
            <input type="text"  name="email" value="" id="email">
            @error('email')
            {{$message}}
            @enderror
            <br>
            <label for="password">Password</label>
            <input type="text"  name="password" value="" id="password">
            @error('password')
            {{$message}}
            @enderror
            <br>
            <label for="password_confirmation">Confirm Password</label>
            <input type="text"  name="password_confirmation" value=""  id="password_confirmation"> 
            @error('password')
            {{$message}}
            @enderror
            <button type="submit">Submit</button>
        </form>
    </div><br>
    <a type="button" class="btn btn-secondary"  href="{{route('home')}}">Back</a>

@endsection