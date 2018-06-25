<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Anthropi @yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/mdb-pro.min.css') }}">

  </head>

  <body>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/mdb-pro.min.js') }}"></script>
  </body>
</html>
