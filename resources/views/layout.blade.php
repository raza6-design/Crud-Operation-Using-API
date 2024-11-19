<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrapcss/bootstrap.min.css') }}">
    <style>
      

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>@yield('head')</h2>
        </div>
        <div class="sub-head">
           <h3> @yield('sub-head')</h3>
        </div>
          @yield('content')
    </div>
    <script src="{{ asset('bootstrapjs/bootstrap.bundle.min.js') }}"></script>    
</body>
</html>