<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view("question.create",compact("quiz"));
    }
    public function store(Request $request)
    {
        $rules=[
            "title"=>"required|min:10|max:100",
            "answers"=>"required|min:10|max:1000",
            "right_answer"=>"required|min:1|max:100",
            "score"=>"required|integer|in:5,10,15,20,25",
            "quiz_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        Question::create($request->all());
        $notification = array(
            'message_id' => 'Question has been Created Successfully',
            'alert-type' => 'info'
        );
        return  redirect()->route("quizzes.show",$request->quiz_id)->with($notification);
    }
    public function edit(Question $question)
    {
        return view("question.edit",compact("question"));
    }
    public function update(Request $request, Question $question)
    {
        $rules=[
            "title"=>"required|min:10|max:100",
            "answers"=>"required|min:10|max:1000",
            "right_answer"=>"required|min:1|max:100",
            "score"=>"required|integer|in:5,10,15,20,25",
            "quiz_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $question->update($request->all());
        $notification = array(
            'message_id' => 'Question has been Updated Successfully',
            'alert-type' => 'info'
        );
        return  redirect()->route("quizzes.show",$request->quiz_id)->with($notification);
    }
    public function destroy(Question $question)
    {
        $question->delete();
        $notification = array(
            'message_id' => 'Question has been Deleted Successfully',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }
}
