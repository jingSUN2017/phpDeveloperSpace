@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-10">
            <?php $n=0;?>
                @foreach($blogs as $blog)
                    <article class="post" data-postid="{{ $blog->id }}">
                            <p class="topic-info">
                                <b>{{$blog->user->getUsername()}}</b> >>{{$timeFormat[$n]}} >>
                                {{$blog->likes->where('like',1)->count()}} {{str_plural('like',$blog->likes->where('like',1)->count())}}
                                @if(Auth::check() && $blog->user_id != Auth::user()->id)
                                    <span class="pull-right">
                                        <a href="#" class="like">
                                            {{ Auth::user()->likes()->where('blog_id', $blog->id)->first() ? Auth::user()->likes()->where('blog_id', $blog->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}
                                        </a>
                                    </span>
                                @endif
                                <br><p><a href={{route('blog.getBlog',['id'=>$blog->id])}}>{{$blog->title}}</a></p>
                                {{$blog->body}}
                            </p>
                    <?php $n++;?>
                    </article>

                    @if(!$blog->replies->count())
                        <div class="reply media">
                            <p><b>No replies so far</b></p>
                        </div>
                    @else
                        @foreach($blog->replies as $reply)
                            <div class="reply">
                                <article class="post" data-postid="{{ $reply->id }}">
                                    <h5 class="topic-info"><a href={{route('blog.getBlogs',['user_id'=>$reply->user_id])}}>
                                        <b>{{$reply->user->getUsername()}}</b></a>
                                        <span style="padding-left: 20px;">{{$reply->created_at->diffForHumans()}}</span> >>
                                        {{$blog->likes->count()}} {{str_plural('like',$blog->likes->count())}}
                                        @if(Auth::check() && $reply->user_id != Auth::user()->id)
                                            <span class="pull-right">
                                                 <a href="#" class="like">
                                                    {{ Auth::user()->likes()->where('blog_id', $blog->id)->first() ? Auth::user()->likes()->where('blog_id', $blog->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}
                                                </a>
                                            </span>
                                        @endif
                                    </h5>
                                    <p>{{$reply->body}}</p>
                                </article>
                            </div>
                        @endforeach
                    @endif
                    <hr>
                @endforeach
        </div>
    </div>

    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection