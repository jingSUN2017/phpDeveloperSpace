<?php
namespace App\Http\Controllers;

use App\Models\Blog;

class homeController extends Controller
{
    public function index()
    {
        $bloggs=Blog::notReply()
                ->join('users','users.id','=','blogs.user_id')
                ->select('blogs.*', 'users.username')
                ->orderBy('created_at','desc')
                ->paginate(6);

        $shortenBlogs=array();
        $timeFormat=array();
        $countReply=array();
        $num=0;
        foreach($bloggs as $blog)
        {
            $shortenBlogs[$num]=Blog::shortenText($blog->body,100);
            $timeFormat[$num]=Blog::timeFormat($blog->created_at);
            $countReply[$num]=Blog::countReply($blog->id);
            $num++;
        }
        return view('home')->with('bloggs',$bloggs)
                           ->with('shortenBlogs',$shortenBlogs)
                           ->with('timeFormat',$timeFormat)
                           ->with('countReply',$countReply);
    }
}