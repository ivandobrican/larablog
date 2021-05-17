@extends('layouts.app')
@section('content')
    @include('partials.tinymce')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Update {{$blog->title}}</h1>
        </div>
        <div class="col-md-12">
            <form action="{{route('blogs.update',$blog->id)}}" method="post" enctype="multipart/form-data">
                {{method_field('patch')}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control my-editor">{{$blog->body}}</textarea>
                </div>
                {{csrf_field()}}
                {{$blog->categories->count()?'Current categories' : ''}}&nbsp;
                <div class="form-group form-check form-check-inline">
                    @foreach($blog->categories as $category)
                        <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category->id}}" checked>
                        <label class="form-check-label mr-3">{{$category->name}}</label>
                    @endforeach
                </div>

                {{$filtered->count()?'Unused categories' : ''}}&nbsp;
                <div class="form-group form-check form-check-inline">
                    @foreach($filtered as $category1)
                        <input class="form-check-input" type="checkbox" name="category_id[]" value="{{$category1->id}}">
                        <label class="form-check-label mr-3">{{$category1->name}}</label>
                    @endforeach
                </div>
                <div class="form-group">
                    <label class="btn btn-default">
                        <span class="btn btn-outline btn-sm btn-info" >Featured Image</span>
                        <input type="file" class="form-control" name="featured_image" hidden>
                    </label>
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Update a blog</button>
                </div>

            </form>
        </div>
    </div>
@endsection
