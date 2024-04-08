<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks=Track::select("id","name","created_at")->orderBy("id","desc")->paginate(20);
        return view("tracks.index",compact("tracks"));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:30',
        ];
        $this->validate($request, $rules);
        Track::create($request->all());
        $notification = array(
            'message_id' => 'Track has been Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('tracks.index')->with($notification);
    }
    public function edit(Track $track)
    {
        return view("tracks.edit",compact("track"));
    }
    public function update(Request $request, Track $track)
    {
        $rules = [
            'name' => 'required|string|min:1|max:30',
        ];
        $this->validate($request, $rules);
        $track->update($request->all());
        $notification = array(
            'message_id' => 'Track has been Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('tracks.index')->with($notification);
    }
    public function destroy(Track $track)
    {
        $track->delete();
        $notification = array(
            'message_id' => 'Track has been Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('tracks.index')->with($notification);
    }
}
