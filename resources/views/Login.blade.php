{{-- <script>
    const token = localStorage.getItem('api_token');
        if(token != '' && token != null){
        window.location.href = "http://localhost:8000/dashboard";
    }else{
        window.location.href = "http://localhost:8000/loginpage";
    }
</script> --}}
@extends('layout')
@section('title')
 User Login
@endsection
@section('head')
     User Login Form
@endsection
@section('sub-head')
     Fill The Bellow Form To Login
@endsection
@section('content')
    <style>
               button {
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
            margin-top: 10px;
            padding: 10px;
            border: 2px white;
            border-radius: 16px;
            width: 14%;
            background: #000405;
            color: white;
            font: 900;
            font-weight: bolder;
            margin-top: 16px;
            font-size: 22px;
            margin-left: 45px;
        }
    </style>
    <div class="form">
        <div class="myform"    >
            <label for="email">Email</label>
            <input type="text" value="" name="email" id="email">
             <br><br>
            <label for="password">Password</label>
            <input type="text"  name="password" value="" id="password">
            <button  id="loginButton">Login</button>
        </div>
    </div>
    <br>
        <a  class="btn btn-secondary"  href="/">Back</a>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#loginButton").on('click',function(){
                const email = $("#email").val();
                const password = $("#password").val();

                $.ajax({
                    url:'/api/login',
                    type:'POST',
                    contentType:'application/json',
                    data:JSON.stringify({
                        email:email,
                        password:password,
                    }),
                    success: function(response){
                        console.log(response);

                        localStorage.setItem('api_token', response.token);
                        window.location.href = "/dashboard"
                    },
                    error:function(xhr,status,error){
                        alert('Error:' . xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection