@extends('layouts.app')
@section('title', 'Posts')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{ route('blog.index')}}" class="btn btn-outline-primary btn-sm">Return</a>
                <h4 class="display-5 mt-5">
                {{ $blogPost->title }}
                </h4>
                <hr>
                <p>
                    {{ $blogPost->body }}
                </p>
                <strong>Author: {{$blogPost->blogHasUser->name}}</strong>
                <hr>           
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <a href="{{ route('blog.edit', $blogPost->id)}}" class="btn btn-primary">Update</a>
            </div>
            <div class="col-6">
                <form  method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
                
            </div>
        </div>
    </div>
@endsection