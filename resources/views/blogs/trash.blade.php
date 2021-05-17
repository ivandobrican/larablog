@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Thrashed Blogs</h1>
        </div>
    </div>
    <div class="col-md-12">
        @foreach($blogs as $blog)
            <h1>{{$blog->title}}</h1>
            <p>{{$blog->body}}</p>
        <div class="btn-group">
            <form method="get" action="{{route('blogs.restore',$blog->id)}}">
                <button type="submit" class="btn btn-success btn-xs pull-left mr-3">Restore</button>
                {{csrf_field()}}
            </form>
            <form method="post" action="{{route('blogs.permanent-delete',$blog->id)}}">
                <button type="submit" class="btn btn-danger btn-xs pull-left mr-3">Permanent Delete</button>
                {{csrf_field()}}
                {{method_field('delete')}}
            </form>
        </div>

        @endforeach
    </div>

@endsection
