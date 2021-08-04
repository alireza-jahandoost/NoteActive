<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',new Role);
        $roles = Role::paginate(10);
        return view('roles.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',new Role);
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',new Role);

        $data = $request->validate([
            'name' => 'required|string|between:3,255|unique:roles',
            'permissions' => 'nullable|array',
            'permission' => 'in_array:permissions|numeric',
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        foreach ($data['permissions'] as $id) {
            $permission = Permission::findOrFail($id);
            $role->permissions()->attach($permission);
        }

        return redirect(route('roles.edit',$role->id))->with([
            'class' => 'success',
            'title' => 'Success',
            'message' => 'The Role Has been Created',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update',$role);

        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update',$role);

        $data = $request->validate([
            'name' => "required|string|between:3,255|unique:roles,name,$role->id",
        ]);
        $name = $data['name'];
        $role->update([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        return back()->with([
            'class' => 'success',
            'title' => 'Success',
            'message' => 'The role has been updated',
        ]);
    }

    public function add_permission(Request $request , Role $role)
    {
        $this->authorize('update',$role);

        $data = $request->validate(['permission' => 'required|numeric']);
        $permission = Permission::findOrFail($data['permission']);
        $role->permissions()->attach($permission);
        return back()->with([
            'class' => 'success',
            'title' => 'Success',
            'message' => 'The Permission has been added',
        ]);
    }

    public function remove_permission(Request $request , Role $role)
    {
        $this->authorize('update',$role);

        $data = $request->validate(['permission' => 'required|numeric']);
        $permission = Permission::findOrFail($data['permission']);
        $role->permissions()->detach($permission);
        return back()->with([
            'class' => 'danger',
            'title' => 'Success',
            'message' => 'The Permission has been removed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete',$role);

        if (count($role->users) > 0) {
            return back()->withErrors("Role \"$role->name\" has some users. to delete this role you have to change users's roles or delete users with this role.");
        }else{
            $role->delete();
            return back()->with([
                'class' => 'danger',
                'title' => 'Success',
                'message' => 'The Role Has been Deleted successfully'
            ]);
        }
    }
}
