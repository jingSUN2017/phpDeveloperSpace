<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use DB;

class searchController extends Controller
{
   public function getSearchResult(Request $request){
       $query = $request->input('query');

       if(!$query){
           return redirect()->route('home');
       }
       $users=User::where(DB::raw("CONCAT(first_name, ' ',last_name)"),'like',"%{$query}%")
           ->orWhere('username','like',"%{$query}%")
           ->get();

       $blogs=Blog::where('title','like',"%{$query}%")
           ->orWhere('body','like',"%{$query}%")
           ->get();


       return view('search.searcher')->with('users',$users)
           ->with('blogs',$blogs);
   }
}