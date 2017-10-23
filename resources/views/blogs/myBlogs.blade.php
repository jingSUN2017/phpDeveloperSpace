@extends('templates.default')

@section('content')
    <section class="row">
        <div class="col-lg-10">
            @if(empty($myBlogs))
                <p>You have no blogs so far.</p>
                <a href="{{route('blog.createBlogs')}}"> Go to create one</a>
            @else
                <?php $n=0;?>
                @foreach($myBlogs as $blog)
                    <article class="post" data-postid="{{ $blog->id }}">
                        <p class="topic-info">
                            {{$timeFormat[$n]}} >>
                            {{$blog->likes->where('like',1)->count()}} {{str_plural('like',$blog->likes->where('like',1)->count())}}
                            <span class="pull-right"><a href="#" class="editMyBlog">edit</a> ||  <a href="{{ route('blog.delete', ['blog_id' => $blog->id]) }}">delete</a></span>
                            @if(Auth::check() && $blog->user_id != Auth::user()->id)
                                <span class="pull-right">
                                            <a href="#" class="like">
                                                {{ Auth::user()->likes()->where('blog_id', $blog->id)->first() ? Auth::user()->likes()->where('blog_id', $blog->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}
                                            </a>
                                        </span>
                            @endif
                        </p>
                        <p><a href={{route('blog.getBlog',['id'=>$blog->id])}}>{{$blog->title}}</a><span class="badge" style="margin-left: 15px;"><?php echo empty($countReply[$n])?'0':$countReply[$n];?></span></p>

                        <p>{{$blog->body}}</p>
                        <?php $n++;?>
                    </article>

                @if(!$blog->replies->count())
                    <div class="reply media">
                        <p><span style="font-style: italic;font-size: small;">No replies so far</span></p>
                    </div>
                @else
                    @foreach($blog->replies as $reply)
                        <div class="reply" style="margin-top: 20px;">
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
            @endif
        </div>
    </section >

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">edit my blog</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection