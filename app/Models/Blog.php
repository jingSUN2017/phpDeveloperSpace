<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Blog extends Model
{
    protected $fillable = [
        'body',
        'title',
        'user_id',
        'parent_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public static function timeFormat($date)
    {
        return Carbon::parse($date)->format('F j, Y, g:i a');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeReply($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Blog','parent_id');
    }

    public static function countReply($blog_id)
    {
        return Blog::where('parent_id',$blog_id)->count();
    }

    public static function shortenText($text,$chars){
        $text=substr($text,0,$chars);
        $text=substr($text,0,strrpos($text,' '));
        $text=$text."...";
        return $text;
    }
}