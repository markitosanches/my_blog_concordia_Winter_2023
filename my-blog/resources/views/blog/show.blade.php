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
                <p>
                <strong>Category:</strong> {{$blogPost->blogHasCategory?->category}} 
                </p>
                <strong>Author:</strong> {{$blogPost->blogHasUser->name}}
                <hr>           
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <a href="{{ route('blog.pdf', $blogPost->id)}}" class="btn btn-warning">PDF</a>
            </div>
            <div class="col-4">
            @can('edit-blog-posts')
                <a href="{{ route('blog.edit', $blogPost->id)}}" class="btn btn-primary">Update</a>
            @endcan
            </div>
            <div class="col-4">
            @can('delete-blog-posts')
                <form  method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            @endcan
            </div>
        </div>
    </div>
@endsection