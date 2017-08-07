@extends('templates.default')

@section('content')
    <div class="container">
        <div class="title">phpLoverSpace PHP Quiz</div>
        <div class="sidebar-module sidebar-module-inset">
            <div class="showPosition">
                <p><h3>Result:</h3></p>
                <p><h4>{{$score}} of {{App\Models\Quizzer::calculateNums()}}</h4></p>
                <p><h4><b>{{$percentage}}%</b></h4></p>
                <p><h4>{{$comment}}</h4></p>
            </div>
            <div class="showPosition">
                <a href="{{route('quizzer.checkAnswers')}}"><input type="submit" value="Check your answer"/></a>
                <span><a href="{{route('quizzer.index')}}"><input type="submit" value="Try again"/></a></span>
            </div>
        </div>
    </div>
@endsection