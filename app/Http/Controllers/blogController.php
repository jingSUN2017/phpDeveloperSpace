<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Like;

class blogController extends Controller
{
    public function createBlogs()
    {
        return view('blogs.createBlog');
    }
    public function postBlogs(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required|min:10|max:20000'
        ]);
        Blog::create([
            'title'=>$request->input('title'),
            'user_id'=>Auth::user()->id,
            'body'=>$request->input('body'),
            'category_id'=>'2',
        ]);
        return redirect()->route('home')->with('info','Posted one Blog.');
    }
    public function getBlog($id)
    {
        $blog=Blog::where('id',$id)->first();
        $date=Blog::timeFormat($blog['created_at']);
        $countReply=Blog::countReply($blog['id']);
        return view('blogs.blog')->with('blog',$blog)
                                 ->with('date',$date)
                                 ->with('countReply',$countReply);
    }
    public function postReply(Request $request,$statusId)
    {
        $this->validate($request,[
            "reply-{$statusId}"=>'required|max:1000'], [
            'required'=>'The reply body is required.'
        ]);

        $status=Blog::notReply()->find($statusId);

        if(!$status)
        {
            dd('aa');
        }

        $reply=Blog::create([
            'body'=>$request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }
    public function getBlogs($user_id)
    {
        $blogs1=Blog::notReply()->where('user_id',$user_id);

        if(!empty(Blog::where('user_id',$user_id)->select('parent_id'))){
            $parent_id=Blog::where('user_id',$user_id)->select('parent_id')->get();
            $blogs2=DB::table('blogs')->whereIn('id',$parent_id);
            $blogs1=$blogs1->union($blogs2)->get();
        }


        $timeFormat=array();
        $num=0;
        foreach($blogs1 as $blog)
        {
            $timeFormat[$num]=Blog::timeFormat($blog->created_at);
            $num++;
        }

        return view('blogs.blogs')->with('blogs',$blogs1)
                                  ->with('timeFormat',$timeFormat);
    }
    public function postLikeBlog(Request $request)
    {
        $is_like = (boolean)$request['isLike'];
        $blog_id = $request['postId'];
        $update = false;
        $blog = Blog::find($blog_id);
        if (!$blog) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('blog_id', $blog_id)->first();

        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;

        $like->user_id = $user->id;

        $like->blog_id = $blog->id;

        if ($update) {
            $like->update();

        } else {
            $like->save();
        }
        return null;
    }
}