@extends('layout')
@section('title')
    Update Post
@endsection
@section('head')
    Update Post 
@endsection
@section('sub-head')
    Update Post Form
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
    </style>
    <div class="form">
        <form class="myform" action="" method="POST" >
            @csrf
            <label for="title">Title</label>
            <input type="text" value="{{old('title')}}"  name="title" id="title">
            @error('title')
                {{$message}}
            @enderror
             <br><br>
            <label for="description">Description</label>
            <input type="text" value="{{old('description')}}" name="description" id="description">
            @error('title')
            {{$message}}
            @enderror
            <br><br>
            <label for="image">Image</label>
            <input type="text" value="{{old('image')}}" name="image" id="image">
            @error('image')
            {{$message}}
            @enderror            
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection