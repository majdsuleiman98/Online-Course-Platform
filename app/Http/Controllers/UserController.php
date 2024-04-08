<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(User $model)
    {
        $users=User::select("id","name","email","created_at")->where("is_admin",0)->orderBy("id","desc")->paginate(15);
        return view('users.index',compact("users"));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        $notification = array(
            'message_id' => 'User has been created Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.index')->with($notification);
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ];
        $this->validate($request, $rules);
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));
        $notification = array(
            'message_id' => 'User has been updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')->with($notification);
    }
    public function destroy(User  $user)
    {
        $user->delete();
        $notification = array(
            'message_id' => 'User has been deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.index')->with($notification);
    }
}
