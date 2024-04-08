<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Photo;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Providers\Relation;
class CourseController extends Controller
{
    public function index()
    {
        $courses=Course::orderBy("id","desc")->paginate(20);
        return view("courses.index",compact("courses"));
    }
    public function create()
    {
        $tracks=Track::select("id","name")->get();
        return view("courses.create",compact("tracks"));
    }
    public function store(Request $request)
    {
        $rules=[
            "title"=>"required|min:5|max:50",
            "description"=>"required|min:10|max:500",
            "price"=>"required|min:0|numeric",
            "track_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $request["slug"]=strtolower(str_replace(" ","-",$request->title));
        $course=Course::create($request->all());
        if($file=$request->file("image"))
        {
            $filename=$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_store=time()."_".explode(".",$filename)[0]."_".$extension;
            if($file->move("images",$file_store))
            {
                Photo::create([
                    "filename"=>$file_store,
                    "photoable_id"=>$course->id,
                    "photoable_type"=>"App\Models\Course",
                ]);
            }
        }
        $notification = array(
            'message_id' => 'Course has been Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('courses.index')->with($notification);
    }
    public function show(Course $course)
    {
        return view("courses.show",compact("course"));
    }
    public function edit(Course $course)
    {
        $tracks=Track::select("id","name")->get();
        return view("courses.edit",compact("course","tracks"));
    }
    public function update(Request $request, Course $course)
    {
        $rules=[
            "title"=>"required|min:5|max:50",
            "description"=>"required|min:10|max:500",
            "price"=>"required|min:0|numeric",
            "track_id"=>"required|integer",
        ];
        $this->validate($request,$rules);
        $course->update($request->all());
        if($file=$request->file("image"))
        {
            $filename=$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_store=time()."_".explode(".",$filename)[0]."_".$extension;
            if($file->move("images",$file_store))
            {
                if($course->photo)
                {
                    $photo=$course->photo;
                    $filename=$course->photo->filename;
                    unlink("images/".$filename);
                    $photo->filename=$file_store;
                    $photo->save();
                }
                else
                {
                    Photo::create([
                        "filename"=>$file_store,
                        "photoable_id"=>$course->id,
                        "photoable_type"=>"App\Models\Course",
                    ]);
                }
            }
        }
        $notification = array(
            'message_id' => 'Course has been Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('courses.index')->with($notification);
    }
    public function destroy(Course $course)
    {
        if($course->photo)
        {
            $filename=$course->photo->filename;
            unlink("images/".$filename);
            $course->photo->delete();
        }
        $course->delete();
        $notification = array(
            'message_id' => 'Course has been Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('courses.index')->with($notification);
    }
}
