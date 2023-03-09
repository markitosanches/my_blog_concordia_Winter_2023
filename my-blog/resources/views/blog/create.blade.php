@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <h1 class="display-5">
                    @lang('lang.new_post')
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
                            @lang('lang.form')
                        </div>
                        <div class="card-body">   
                                <div class="col-12">
                                    <label for="title">@lang('lang.title')</label>
                                    <input type="text" id="title" name="title" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="message">@lang('lang.message')</label>
                                    <textarea class="form-control" id="message" name="body"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="category">@lang('lang.category')</label>
                                    <select name="categories_id" id="category" class="form-control">
                                        <option value="">@lang('lang.select')</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-success" value="@lang('lang.save')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div><!--/container-->

@endsection