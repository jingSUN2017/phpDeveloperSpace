@extends('templates.default')

@section('content')
    <div class="media">
        <li class="topic">
            <div class="col-md-10">
                <div class="topic-content">
                    <article class="post" data-postid="{{ $blog->id }}">
                    <div class="topic-info">
                        {{$blog->user->getUsername()}} >>
                        {{$date}} >>
                        {{$blog->likes->where('like',1)->count()}} {{str_plural('like',$blog->likes->count())}}
                        @if(Auth::check() && $blog->user_id != Auth::user()->id)
                            <span class="pull-right">
                                 <a href="#" class="like">
                                     {{ Auth::user()->likes()->where('blog_id', $blog->id)->first() ? Auth::user()->likes()->where('blog_id', $blog->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}
                                 </a>
                            </span>
                        @endif
                    </div>
                    </article>
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
                    <article class="post" data-postid="{{ $reply->id }}">
                    <h5 class="topic-info">
                        {{$reply->user->getUsername()}} >>
                            {{$reply->created_at->diffForHumans()}} >>
                            {{$reply->likes->where('like',1)->count()}} {{str_plural('like',$reply->likes->count())}}
                        @if(Auth::check() && $reply->user_id != Auth::user()->id)
                            <span class="pull-right">
                                <a href="#" class="like">
                                     {{ Auth::user()->likes()->where('blog_id', $blog->id)->first() ? Auth::user()->likes()->where('blog_id', $blog->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}
                                </a>
                            </span>
                        @endif
                    </h5>
                    </article>
                    <p>{{$reply->body}}</p>

                    <div class="comment">Leave a comment
                        <div class="commentContainer">
                            <form role="form" action="{{route('blog.reply',['statusId'=>$blog->id])}}" method="post" style="padding-left: 20px">
                                 <div class="form-group{{ $errors->has("reply-{$blog->id}")?' has-error':'' }}">
                                    <textarea name="reply-{{$blog->id}}" class="form-control" rows="2" placeholder="Reply to this comment"></textarea>
                                        @if($errors->has("reply-{$blog->id}"))
                                            <span class="help-block">{{$errors->first("reply-{$blogs->id}")}}</span>
                                        @endif
                                 </div>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                            </form>
                        </div>
                    </div>
                </div>

            <hr>
        @endforeach
    </div>
    <div class="col-md-9" style="margin-top: 25px;">
        <form role="form" action="{{route('blog.reply',['statusId'=>$blog->id])}}" method="post">
            <div class="form-group{{ $errors->has("reply-{$blog->id}")?' has-error':'' }}">
                <textarea name="reply-{{$blog->id}}" class="form-control" rows="2" placeholder="Reply to this blog"></textarea>
                @if($errors->has("reply-{$blog->id}"))
                    <span class="help-block">{{$errors->first("reply-{$blogs->id}")}}</span>
                @endif
            </div>
            <input type="submit" value="Reply" class="btn btn-default btn-sm">
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>

    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
    </script>

@endsection