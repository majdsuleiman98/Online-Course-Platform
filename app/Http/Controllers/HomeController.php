<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Track;
use App\Models\Course;
use App\Models\User;
use App\Models\Quiz;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $auth_user=Auth::user()->is_admin;
        if($auth_user===0)
        {
            $user_courses=User::findOrFail(Auth::user()->id)->courses;
            $tracks_courses=Track::with("courses")->orderBy("id","desc")->limit(5)->get();
            $user_courses_ids=User::findOrFail(Auth::user()->id)->courses()->pluck("id");
            $user_tracks_ids=array();
            foreach($user_courses as $course)
            {
                array_push($user_tracks_ids,$course->track->id);
            }
            $recommended_courses=Course::whereIn("track_id",$user_tracks_ids)
            ->whereNotIn("id",$user_courses_ids)->limit(5)->get();
            return view('userhome',compact("user_courses","tracks_courses","recommended_courses"));
        }
        elseif($auth_user===1)
        {
            $courses=Course::orderBy("id","desc")->limit(8)->get();
            $tracks=Track::orderBy("id","desc")->limit(8)->get();
            return view('dashboard',compact("courses","tracks"));
        }
        else
        {
            return abort(404);
        }
    }
}
