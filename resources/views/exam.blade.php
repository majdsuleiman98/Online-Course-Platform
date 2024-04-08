<?php
if (Auth::check()) {
    $check_done_courses_ids = App\Models\Exam::where('user_id', Auth::user()->id)->pluck('quiz_id');
}
?>
@extends('layouts.user_layout')
@section('content')
    <div class="container mt-5 mb-5" style="background-color: #eee;">
        <div class="contain" style="margin-top: 30px;">
            @if (\Session::has('worng_answers'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="width: 90%; margin-left: auto; margin-right: auto;">
                    Your False Answers : {!! implode(', ', \Session::get('worng_answers')) !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (\Session::has('right_answers'))
                <div class="alert alert-info alert-dismissible fade show" role="alert"
                    style="width: 90%; margin-left: auto; margin-right: auto;">
                    Your True Answers : {!! implode(', ', \Session::get('right_answers')) !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (\Session::has('score'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="width: 90%; margin-left: auto; margin-right: auto;">
                    Your Score : {!! \Session::get('score') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <h1>{{ $quiz->name }}</h1>
        @auth
            @if ($check_done_courses_ids->contains($quiz->id))
            <?php $score=App\Models\Exam::where('user_id', Auth::user()->id)->where("quiz_id",$quiz->id)->pluck('score');?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
            style="width: 90%; margin-left: auto; margin-right: auto;">You have done this test before - with {{$score}} point.</div>
            @else
                <p>Answer the following questions:</p>
                <form action="{{ route('submit-quiz', [$quiz->course->slug, $quiz->name]) }}" method="post">
                    @csrf
                    @foreach ($quiz->questions as $question)
                        <div style="display: flex; justify-content: start ">
                            <p>{{ $question->title }}</p>
                            <span style="color: #777; margin-left: 10px;">({{ $question->score }} point)</span>
                        </div>
                        <?php $answers = explode(',', $question->answers); ?>
                        @foreach ($answers as $answer)
                            <label><input type="radio" name="answer{{ $question->id }}"
                                    value="{{ $answer }}">{{ $answer }}</label><br>
                        @endforeach
                    @endforeach
                    <input type="submit" value="Submit">
                </form>
            @endif
        @endauth

    </div>




    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        h1,
        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #008CBA;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00688B;
        }
    </style>
@endsection
