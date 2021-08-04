<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',new User);

        $users = User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function index_by_role(Role $role)
    {
        $this->authorize('viewByRole' , new User);

        $users = User::whereRoleId($role->id)->paginate(10);
        return view('admin.users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view',new User);

        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update',$user);

        $data = $request->validate([
            'name' => 'required|string|between:3,30',
            'username' => "required|string|between:3,30|unique:users,username,$user->id",
            'email' => "required|email|unique:users,email,$user->id",
            'delete_profile_image' => 'nullable',
            'about' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|file|mimes:jpg,png,gif|max:3000',

        ]);
        if ((isset($data['delete_profile_image'])) && Storage::exists($user->profile_image)) {
            Storage::delete($user->profile_image);
            $data['profile_image'] = NULL;
        }
        if (isset($data['profile_image'])) {
            if (Storage::exists($user->profile_image)) {
                Storage::delete($user->profile_image);
            }
            $image = $request->file('profile_image');
            $data['profile_image'] = $image->store('images');
        }
        $user->update($data);
        return back()->withMessage('Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete' , $user);

        $user->delete();
        return back()->with([
            'message' => 'user deleted successfully',
            'class' => 'danger',
            'title' => 'Success'
        ]);
    }

    public function edit_password(User $user)
    {
        $this->authorize('changePassword',$user);

        return view('admin.users.edit_password',compact('user'));
    }

    public function update_password(Request $request , User $user)
    {
        $this->authorize('changePassword',$user);

        $data = $request->validate([
            'password' => 'required|between:6,255',
            'confirm' => 'required|between:6,255',
        ]);
        if ($data['password'] !== $data['confirm']) {
            return back()->withErrors('password and confirm password do not match');
        }
        $user->password = bcrypt($data['password']);
        $user->save();
        return back()->withMessage('Password Changed Successfully');
    }

    public function edit_role(User $user)
    {
        $this->authorize('updateRole',$user);

        $roles = Role::all();
        return view('admin.users.edit_role',compact('user','roles'));
    }

    public function update_role(Request $request , User $user)
    {
        $this->authorize('updateRole',$user);

        $data = $request->validate(['role' => 'required|numeric']);
        $role = Role::findOrFail($data['role']);
        $user->role_id = $role->id;
        $user->push();

        return back()->with([
            'title' => 'Success',
            'class' => 'success',
            'message' => "role of user has been changed to $role->name"
        ]);

    }
}
