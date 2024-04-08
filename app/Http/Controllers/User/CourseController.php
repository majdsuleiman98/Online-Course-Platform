<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Track;
use App\Models\User;
use App\Models\Video;
class CourseController extends Controller
{
    public function index ($slug)
    {
        $course=Course::where("slug",$slug)->first();
        return view("user_course.course",compact("course"));
    }
    public function get_all_courses()
    {
        $tracks=Track::orderBy("id","desc")->get();
        return view("user_course.allcourses",compact("tracks"));
    }
    public function get_course_info($slug)
    {
        $course=Course::where("slug",$slug)->first();
        return view("user_course.course_info",compact("course"));
    }
    public function my_courses()
    {
        $user_courses=User::findOrFail(Auth::user()->id)->courses;
        return view("user_course.my_courses",compact("user_courses"));
    }
}
