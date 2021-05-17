@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        @if(\Illuminate\Support\Facades\Auth::user()->role_id === 1)
            <h1>Admin Dashboard</h1>
        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id === 2)
            <h1>Author Dashboard</h1>
        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id === 3)
            <h1>User Dashboard</h1>
        @endif
    </div>
    @if(\Illuminate\Support\Facades\Auth::user()->role_id === 1)
        <div class="col-md-12">
           <a class="btn btn-primary mr-2" href="{{route('blogs.create')}}">Create a blog</a>
           <a class="btn btn-danger mr-2" href="{{route('blogs.trash')}}">Thrashed blogs</a>
            <a class="btn btn-warning mr-2" href="{{route('categories.create')}}">Create a category</a>
            <a class="btn btn-info mr-2" href="{{route('users.index')}}">Manage users</a>
            <a class="btn btn-success mr-2" href="{{route('admin.blogs')}}">Publish Blogs</a>
        </div>
    @elseif(\Illuminate\Support\Facades\Auth::user()->role_id === 2)
            <div class="col-md-12">
                <a class="btn btn-primary mr-2" href="{{route('blogs.create')}}">Create a blog</a>
                <a class="btn btn-warning mr-2" href="{{route('categories.create')}}">Create a category</a>
            </div>
    @elseif(\Illuminate\Support\Facades\Auth::user()->role_id === 3)
            <div class="col-md-12">
                 <a class="btn btn-primary mr-2" href="#">What should i do?</a>
            </div>
    @endif
@endsection
