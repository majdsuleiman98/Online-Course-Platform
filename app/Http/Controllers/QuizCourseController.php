<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;  
class QuizCourseController extends Controller
{
    public function create(Course $course)
    {
        return view("courses.createquiz",compact("course"));
    }
}
