@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <h1 class="display-5">
                    New post
                </h1>
            </div> <!--/col-12-->
        </div><!--/row-->
                <hr>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form method="post">
                        @csrf
                        <div class="card-header">
                            Form
                        </div>
                        <div class="card-body">   
                                <div class="col-12">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="body"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="category">Category</label>
                                    <select name="categories_id" id="category" class="form-control">
                                        <option value="">Select the category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div><!--/container-->

@endsection