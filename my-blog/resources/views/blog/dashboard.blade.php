@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="display-5">User List</h1>
        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users }}
            </div>
        </div>
    </div>
@endsection