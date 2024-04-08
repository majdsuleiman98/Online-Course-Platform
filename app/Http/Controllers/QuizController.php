<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes=Quiz::orderBy("id","desc")->paginate(20);
        return view("quiz.index",compact("quizzes"));
    }
    public function create()
    {
        $courses=Course::select("id","title")->get();
        return view("quiz.create",compact("courses"));
    }
    public function store(Request $request)
    {
        $rules=[
            "name"=>"required|string|min:3|max:50",
            "course_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        Quiz::create($request->all());
        $notification = array(
            'message_id' => 'Quiz has been Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('courses.show',$request->course_id)->with($notification);
    }
    public function show(Quiz $quiz)
    {
        return view("quiz.show",compact("quiz"));
    }
    public function edit(Quiz $quiz)
    {
        $courses=Course::select("id","title")->get();
        return view("quiz.edit",compact("quiz","courses"));
    }
    public function update(Request $request, Quiz $quiz)
    {
        $rules=[
            "name"=>"required|string|min:3|max:50",
            "course_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $quiz->update($request->all());
        $notification = array(
            'message_id' => 'Quiz has been Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('courses.show',$request->course_id)->with($notification);
    }
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        $notification = array(
            'message_id' => 'Quiz has been Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
