@extends('templates.default')

@section('content')
    <div class="container">
        <h2><b>PHP Quiz</b></h2>
        <p>You can test your PHP skills with phpLoverSpace' Quiz.</p>
        <hr>
        <h3>The Test</h3>
        <p>The test contains 25 questions and there is no time limit.<br><br>
            The test is not official, it's just a nice way to see how much you know, or don't know, about PHP.</p>
        <h3><br>Count Your Score</h3>
        <p>You will get 1 point for each correct answer. At the end of the Quiz, your total score will be displayed. Maximum score is 25 points.</p>
        <h3><br>Count Your Score</h3>
        <p>Good luck!</p>
    </div>

    <div class="container">
        <a class="start" href="{{route('quizzer.questions',['num'=>1])}}" ><span>Start the Quiz</span></a>
    </div>
@endsection