<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $rules=[
            "title"=>"required|min:5|max:50",
            "link"=>"required",
            "course_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $video=Video::create($request->all());
        $notification = array(
            'message_id' => 'Video has been Created Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('courses.show',$request->course_id)->with($notification);
    }
    public function edit(Video $video)
    {
        return view("videos.edit",compact("video"));
    }
    public function update(Request $request, Video $video)
    {
        $rules=[
            "title"=>"required|min:5|max:50",
            "link"=>"required",
            "course_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $video->update($request->all());
        $notification = array(
            'message_id' => 'Video has been Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('courses.show',$request->course_id)->with($notification);
    }
    public function destroy(Video $video)
    {
        $video->delete();
        $notification = array(
            'message_id' => 'Video has been Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
