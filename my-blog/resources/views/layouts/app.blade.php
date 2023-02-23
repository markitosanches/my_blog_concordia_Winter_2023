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
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hello @if(Auth::check()) {{ Auth::user()->name }} @else Guest @endif</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            @guest    
                <a class="nav-link" href="{{route('user.registration')}}">Registration
                </a>
                <a class="nav-link" href="{{route('login')}}">Login</a>
            @else
                <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                <a class="nav-link" href="{{route('blog.index')}}">Blogs</a>
                <a class="nav-link" href="{{route('logout')}}">Logout</a>
            @endguest
            </div>
        </div>
    </div>
</nav>
 @yield('content')
</body>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</html>