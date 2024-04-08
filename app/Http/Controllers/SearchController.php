<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Track;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $tracks=Track::all();
        if($request->search)
        {
            $item = $request->search;
            $courses=Course::where("title","like","%".$item."%")->get();
        }
        if($request->track)
        {
            $track=Track::where("name",$request->track)->first();
            $courses=Course::where("track_id",$track->id)->get();
        }
        return view("user_course.search_result",compact("courses","tracks"));
    }
}
