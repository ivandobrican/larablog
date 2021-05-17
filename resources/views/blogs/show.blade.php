@extends('layouts.app')
@include('partials.meta_dynamic')
@section('content')

    <div class="container-fluid">
        <article>
            <div class="jumbotron">
                <div class="col-md-12">
                    @if($blog->featured_image)
                        <img src="/images/featured_image/{{$blog->featured_image?$blog->featured_image:''}}" class="featured-image img-responsive">
                    @endif
                </div>
                <div class="col-md-12">
                    <h1>{{$blog->title}}</h1>
                </div>

                @if(\Illuminate\Support\Facades\Auth::user())
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id === 1 || \Illuminate\Support\Facades\Auth::user()->role_id === 2 && \Illuminate\Support\Facades\Auth::user()->role_id === $blog->user_id)
                        <div class="btn-group">
                            <a class="button btn btn-primary btn-sm mr-3 pull-left" href="{{route('blogs.edit',$blog->id)}}">Edit </a>
                            <form action="{{route('blogs.delete',$blog->id)}}" method="post">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <button class="btn btn-danger btn-sm pull-left" type="submit" name="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @endif

            </div>
            <div class="col-md-12">
                {!! $blog->body !!}
                <hr>
                <strong>Categories: </strong>
                @foreach($blog->categories as $category)
                    <span><a href="{{route('categories.show',$category->slug)}}">{{$category->name.', '}}</a></span>
                @endforeach
            </div>
        </article>
    </div>
    <div id="disqus_thread"></div>
    <script>
        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'http://larablog-test.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection
