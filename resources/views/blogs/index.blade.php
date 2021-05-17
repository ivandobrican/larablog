@extends('layouts.app')
@include('partials.meta_static')
@section('content')
    <div class="container">
        @if(Session::has('success_mail_message'))
            <div class="alert alert-success">
                {{Session::get('success_mail_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        @endif
        @if(Session::has('create_blog_success'))
            <div class="alert alert-success">
                {{Session::get('create_blog_success')}}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        @endif
        @foreach($blogs as $blog)
            <h1 class="text-center"><a href="{{route('blogs.show',$blog->slug)}}">{{$blog->title}}</a></h1>
                <div class="col-md-12 text-center mb-5">
                    @if($blog->featured_image)
                        <img style="width: 300px;" src="/images/featured_image/{{$blog->featured_image?$blog->featured_image:''}}" class="featured-image">
                    @endif
                </div>
                <div class="lead"> {!!\Illuminate\Support\Str::limit($blog->body,200)!!}</div>
        @if($blog->user)
            Author: <a href="{{route('users.show',$blog->user->name)}}">{{$blog->user->name}}</a> | Posted: {{$blog->created_at->diffForHumans()}}
        @endif
            <hr>
        @endforeach
    </div>

@endsection
