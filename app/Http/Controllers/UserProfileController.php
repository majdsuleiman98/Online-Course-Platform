<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Photo;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user=User::findOrFail(Auth::user()->id);
        return view("profile",compact("user"));
    }
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();
        $notification = array(
            'message_id' => 'Your Profile Updated Successfly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }




    public function upload_image(Request $request, User $user)
    {
        if($file=$request->file("image"))
        {
            $filename=$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_store=time()."_".explode(".",$filename)[0]."_".$extension;
            if($file->move("images",$file_store))
            {
                if($user->photo)
                {
                    $photo=$user->photo;
                    $filename=$user->photo->filename;
                    unlink("images/".$filename);
                    $photo->filename=$file_store;
                    $photo->save();
                }
                else
                {
                    Photo::create([
                        "filename"=>$file_store,
                        "photoable_id"=>$user->id,
                        "photoable_type"=>"App\Models\User",
                    ]);
                }
            }
        }
        $notification = array(
            'message_id' => 'Your Image Updated Successfly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
