<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizzer extends Model
{
    public static function calculateNums()
    {
        return DB::table('quizzers')
            ->where('question_text','!=','NULL')->get()->count();
    }

    public static function correctAnswer($num)
    {
        return Quizzer::where('question_number',$num)
            ->where('is_correct','=','1')->first();
    }
}
