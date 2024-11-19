@extends('layout')

@section('title')
    Add Post
@endsection

@section('head')
    Add New Post
@endsection
@section('sub-head')
    Add post form
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
        <form class="myform"  >
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
            <input type="file" value="{{old('image')}}" name="image" id="image">
            @error('image')
            {{$message}}
            @enderror            
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
        var form = document.querySelector('.myform');
        form.onsubmit = async(e)=>{
            e.preventDefault();

        const token = localStorage.getItem('api_token');
        const title = document.querySelector("#title").value;
        const description = document.querySelector("#description").value;
        const image = document.querySelector("#image").files[0];

        var formData = new FormData();
        formData.append('title',title);
        formData.append('description',description);
        formData.append('image',image);

        let response = await fetch('/api/posts',{
            method: 'POST',
            body: formData,
            headers:{
                'Authorization': `Bearer ${token}`,
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.href = "http://localhost:8000/dashboard";
        })
        }
    </script>
@endsection