<?php
namespace App\Http\Controllers;

use App\Models\Quizzer;
use Illuminate\Http\Request;
use Session;

class testController extends Controller
{
    public function getIndex()
    {
        return view('quizzer.index');
    }
    public function getQuestions($num)
    {
        $questions=Quizzer::where('question_number',$num)->get();

        if(!$questions){
            abort(404);
        }
        return view('quizzer.questions')
            ->with('questions',$questions);
    }

    public function postQuestions(Request $request, $num)
    {
        if($num==1)
        {
            $request->session()->forget('score');
        }
        if(!$request->session()->has('score'))
        {
            session('score', 0);
        }

        $next=$num+1;

        if(isset($_POST['choice']))
        {
            $selected_choice=$_POST['choice'];

            $result=Quizzer::correctAnswer($num);
            $correct_choice=$result['id'];

            if($correct_choice==$selected_choice){
                $value =$request->session()->get('score');
                $value++;
                session(['score' => $value]);
            }
        }
        if($num==Quizzer::calculateNums()){
            return redirect()->route('quizzer.checkResults');

        }else{
            return redirect()->route('quizzer.questions',['num'=>$next]);
        }
    }
    public function getResults()
    {
        if(Session::get('score')==null){
            session(['score' => 0]);
        }
        $percentage=round((Session::get('score')/Quizzer::calculateNums())*100);
        if($percentage<=30){
            $comment="It seems you need spend more time on learning it.";
        }elseif(30<$percentage && $percentage<=60){
            $comment="You still have many things to study, keep holding on!";
        }elseif(60<$percentage && $percentage<=85){
            $comment="Almost! Study a little more and take the test again!";
        }else{
            $comment="Good job! Keep up good work!";
        }
        return view('quizzer.checkResults')
            ->with('score', Session::get('score'))
            ->with('percentage', $percentage)
            ->with('comment', $comment);
    }
    public function getAnswers()
    {
        return view('quizzer.checkAnswers');
    }
}