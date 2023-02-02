@extends('layouts.app')
@section('title', 'Posts')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <h1 class="display-one">My Blog</h1>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>Have a good reading!</p>
                    </div>
                    <div class="col-md-4">
                        <p>Create a new post</p>
                        <a href="" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List of posts</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($posts as $post)
                                <li> <a href="{{ route('blog.show', $post->id)}}">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection