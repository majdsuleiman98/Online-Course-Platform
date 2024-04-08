<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("adminowner");
    }
    public function index()
    {
        $auth_user_id=Auth::user()->id;
        $admins=User::select("id","name","email","created_at")->where("is_admin",1)
        ->whereNotIn("id",[$auth_user_id])->orderBy("id","desc")->paginate(15);
        return view('admins.index',compact("admins"));
    }
    public function create()
    {
        return view('admins.create');
    }
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        $notification = array(
            'message_id' => 'Admin has been Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.index')->with($notification);
    }
    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }
    public function update(Request $request, User $admin)
    {
        $rules = [
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ];
        $this->validate($request, $rules);
        $admin->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));
        $notification = array(
            'message_id' => 'Admin has been Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.index')->with($notification);
    }
    public function destroy(User  $admin)
    {
        $admin->delete();
        $notification = array(
            'message_id' => 'Admin has been Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.index')->with($notification);
    }
}
