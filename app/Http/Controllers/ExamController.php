<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug,$name)
    {
        $course = Course::where("slug",$slug)->first();
        $quiz = $course->quizzes()->where("name",$name)->first();
        return view("exam",compact("quiz"));
    }
    public function submit($slug,$name,Request $request)
    {
        $course_id = Course::where("slug",$slug)->pluck("id");
        $quiz = Quiz::where("name",$name)->where("course_id",$course_id)->first();
        $questios =  $quiz->questions;
        $score = 0;
        $worng_answers = array();
        $right_answers = array();
        foreach($questios as $question)
        {
            if($question->right_answer == $request["answer".$question->id])
            {
                $score += $question->score;
                array_push($right_answers, $request["answer".$question->id]);
            }
            else
            {
                array_push($worng_answers, $request["answer".$question->id]);
            }
        }
        Exam::create([
            "user_id"=>Auth()->user()->id,
            "quiz_id"=>$quiz->id,
            "score"=>$score,
        ]);
        return redirect()->back()->with("score",$score)
        ->with("worng_answers",$worng_answers)->with("right_answers",$right_answers);
    }
}
