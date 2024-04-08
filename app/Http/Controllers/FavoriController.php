<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class FavoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $fav_courses=User::findOrfail(Auth::user()->id)->favoris;
        return view("favori",compact("fav_courses"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'course_id' => 'required|numeric',
        ]);
        Favori::create([
            "user_id"=>$request->user_id,
            "course_id"=>$request->course_id,
        ]);
        return redirect()->back();
    }
    public function destroy($course_id)
    {
        DB::table('favoris')->where("user_id",Auth::user()->id)->where("course_id",$course_id)->delete();
        return redirect()->back();
    }
}
