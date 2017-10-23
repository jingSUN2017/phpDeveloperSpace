@extends('templates.default')

@section('content')
     @if(!$bloggs->count())
        <p>No Blogs So Far</p>
     @else
         <?php $n=0;?>
         @foreach($bloggs as $blog)
            <ul>
                <li class="topic">
                    <div class="col-md-10">
                        <div class="topic-content">
                            <h3><a href={{route('blog.getBlog',['id'=>$blog->id])}}> <?php echo $blog->title ;?> </a></h3>
                            <div class="topic-info">
                                <a href="blogs.php?category=<?php echo $blog->category_id;?>">
                                    <?php echo $blog->category_id==1?'PHP News':'Blogers thoughts';?>
                                </a>>>
                                <a href={{route('blog.getBlogs',['user_id'=>$blog->user_id])}}><?php echo $blog->user->username;?></a>>>
                                {{$timeFormat[$n]}}
                                <span class="badge pull-right">{{$countReply[$n]}}</span>
                            </div>
                            <div class="topic-info">
                                <div class="textt">{{$shortenBlogs[$n]}}</div>
                                <a href={{route('blog.getBlog',['id'=>$blog->id])}} class="readmore" >Read More</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
             <?php $n++;?>
         @endforeach
         <div class="pull-right">
            {{$bloggs->links()}}
         </div>
    @endif
@endsection

@section('sideBar')
    @include('templates.partials.sideBar')
@endsection