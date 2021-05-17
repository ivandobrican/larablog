@extends('layouts.app')
@section('content')
    @include('partials.tinymce')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Create a new blog</h1>
        </div>
        <div class="col-md-12">
            @include('partials.error-message')

            <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control my-editor"></textarea>
                </div>
                {{csrf_field()}}
                <div class="form-group form-check form-check-inline">
                    @foreach($categories as $category)
                        <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}">
                        <label class="form-check-label mr-3">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="btn btn-default">
                        <span class="btn btn-outline btn-sm btn-info" >Featured Image</span>
                    <input type="file" class="form-control" name="featured_image" hidden>
                    </label>
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Create a blog</button>
                </div>

            </form>
        </div>
    </div>
@endsection
