@extends('templates.default')

@section('content')
    <div class="media">
        <li class="topic">
            <div class="col-md-10">
                <div class="topic-content">
                    <div class="topic-info">
                        <span style="color: cornflowerblue;">{{$blog->user->getUsername()}}</span> >>
                        {{$date}} >>
                        {{$blog->likes->count()}} {{str_plural('like',$blog->likes->count())}}
                        <span class="pull-right">
                            <a href="#" class="like">Like</a>
                        </span>
                    </div>
                    <h3>{{$blog->title}}</h3>
                    <div class="topic-info">
                        {{$blog->body}}
                    </div>
                </div>
            </div>
        </li>
    </div>
    <div class="reply col-md-10">
        @foreach($blog->replies as $reply)

                <div class="media-body">
                    <h5 class="topic-info">
                        <b><span style="color: cornflowerblue;">{{$reply->user->getUsername()}}</span></b>>>>
                            {{$reply->created_at->diffForHumans()}} >>
                            {{$reply->likes->count()}} {{str_plural('like',$reply->likes->count())}}
                        <span class="pull-right">
                            <a href="#" class="like">Like</a>
                        </span>
                    </h5>
                    <p>{{$reply->body}}</p>
                </div>

            <hr>
        @endforeach
    </div>
    <div class="reply col-md-10">
        <form role="form" action="{{route('blog.reply',['statusId'=>$blog->id])}}" method="post">
            <div class="form-group{{ $errors->has("reply-{$blog->id}")?' has-error':'' }}">
                <textarea name="reply-{{$blog->id}}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
                @if($errors->has("reply-{$blog->id}"))
                    <span class="help-block">{{$errors->first("reply-{$blogs->id}")}}</span>
                @endif
            </div>
            <input type="submit" value="Reply" class="btn btn-default btn-sm">
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
@endsection

@section('sideBar')
    @include('templates.partials.sideBar')
@endsection