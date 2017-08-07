@extends('templates.default')

@section('content')
    <form role="form" method="post" action="{{route('blog.createBlogs')}}">
        <div class="form-group">
            <label for="title">
                Topic Title
            </label>
            <input type="text" name="title" class="form-control"/>
            <label  for="user_id">
                Author
            </label>
            <input type="text" name="user_id" class="form-control" placeholder="{{Auth::user()->username}}" readonly/>
        </div>
        <div class="form-group">
            <label for="body">
                Topic Body
            </label>
            <textarea name="body" id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
        </div>
        <div class="form-group">
            <input name="do_create" type="submit" class="btn btn-default" value="Submit"/>
            <a class="btn btn-default" href="{{route('home')}}">Go Back</a>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </div>
    </form>
@endsection