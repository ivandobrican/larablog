@extends('layouts.app')
@include('partials.meta_static')
@section('content')




    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Manage Blogs</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Published Blogs</h3>
                <hr>
                @foreach($publishedBlogs as $blog)
                    <h2><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></h2>
                    {!!\Illuminate\Support\Str::limit($blog->body,100)!!}

                    <form action="{{route('blogs.update',$blog->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        <input type="hidden" name="status" value="0">
                        <button type="submit" class="btn btn-danger btn-xs">Draft</button>
                    </form>
                @endforeach
            </div>
            <div class="col-md-6">
                <h3>Drafted Blogs</h3>
                <hr>
                @foreach($draftedBlogs as $blog)
                    <h2><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></h2>
                    {!!\Illuminate\Support\Str::limit($blog->body,100)!!}

                    <form action="{{route('blogs.update',$blog->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        <input type="hidden" name="status" value="1">
                        <button type="submit" class="btn btn-success btn-xs">Publish</button>
                    </form>
                @endforeach
            </div>
        </div>

    </div>

@endsection
