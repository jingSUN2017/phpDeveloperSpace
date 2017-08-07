@extends('templates.default')

@section('content')
    <div class="container">
        <div class="title">phpLoverSpace PHP Quiz</div>
        <div class="sidebar-module sidebar-module-inset">
            <p><b>{{$questions->first()['question_number']}}. {{$questions->first()['question_text']}}</b></p>
            <br>
            <br>
            <form name="question" method="post" action="{{route('quizzer.questions',['num'=>$questions->first()['question_number']])}}">
                <ul class="choices">
                    @foreach($questions as $question)
                        <li><input name="choice" type="radio" value="<?php echo $question['id'];?>"/> <?php echo $question['choice_text'];?></li>
                    @endforeach
                </ul>
                <input type="submit" class="start" value="Next" style="color:white"/>
                <input type="hidden" name="_token" value="{{Session::token()}}"/>
            </form>
        </div>
    </div>
    <div class="container">
        <p style="float: right;">{{$questions->first()['question_number']}} out of {{App\Models\Quizzer::calculateNums()}}</p>
    </div>
@endsection