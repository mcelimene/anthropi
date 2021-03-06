<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo.png')}}" type="images/png">
    <title>AnthroPi</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!--<link href="{{ URL::asset("css/material-dashboard.min.css")}}" rel="stylesheet" />-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <div class="container">
        <header class="d-flex justify-content-center mt-4">
          <figure>
            <img src="{{ asset('images/logo.png')}}" alt="Logo AnthroPi" id="logoLogin">
          </figure>
        </header>
      </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
