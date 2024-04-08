<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class VideoCourseController extends Controller
{
    public function create(Course $course)
    {
        return view("videos.create",compact("course"));
    }

}
