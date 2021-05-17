@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <article>
            <div class="jumbotron">
                <div class="col-md-12">
                    <h1>{{$category->name}}</h1>
                </div>


            </div>
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning btn-sm mr-3">Edit category</a>
                    <form action="{{route('categories.destroy',$category->id)}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
                <hr>
                <div class="col-md-12">
                    @foreach($category->blogs as $blog)
                       <h3><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a></h3>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
@endsection
