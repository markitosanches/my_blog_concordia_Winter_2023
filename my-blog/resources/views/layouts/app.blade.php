<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}} @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
</head>
<body>
 @yield('content')
</body>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</html>