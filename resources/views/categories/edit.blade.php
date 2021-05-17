@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Update a category</h1>
        </div>
        <div class="col-md-12">
            <form action="{{route('categories.update',$category->id)}}" method="post">
                {{method_field('patch')}}
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                </div>
                {{csrf_field()}}
                {{method_field('patch')}}
                <button type="submit" name="submit" class="btn btn-primary">Update a category</button>
            </form>
        </div>
    </div>
@endsection
