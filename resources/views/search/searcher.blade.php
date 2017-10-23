@extends('templates.default')

@section('content')
    <h3>You are searching for:  {{Request::input('query')}}</h3>

    @if(!$users->count() && !$blogs->count())
        <p>No results found, sorry.</p>
    @else
        @if($users->count() !== 0 && $blogs->count()===0)
            <div class="row">
                <div class="col-lg-12">
                @foreach($users as $user)
                   @include('search.searchUsers')
                @endforeach
                </div>
            </div>
        @elseif($users->count() === 0 && $blogs->count() !==0)
            <div class="col-lg-12">
                @foreach($blogs as $blog)
                    @include('search.searchBlogs')
                @endforeach
            </div>
        @else
            <div class="col-lg-12">
                @foreach($users as $user)
                    @include('search.searchUsers')
                @endforeach
                <hr>
                @foreach($blogs as $blog)
                    @include('search.searchBlogs')
                @endforeach
            </div>
        @endif
    @endif
@endsection