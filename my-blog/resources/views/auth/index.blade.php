@extends('layouts.app')
@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">
                        Login
                    </h3>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success')}}
                            </div>
                        @endif
                        @if(!$errors->isEmpty())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif  
                        <form action="{{route('authentication')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="email" placeholder="email" class="form-control" name="email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <input type="submit" value="Login" class="btn btn-dark btn-block">
                            </div>
                        </form>
                        <p><a href="{{route('forgot.password')}}">Forgot Password</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection