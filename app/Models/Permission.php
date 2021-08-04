<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public const PERMISSIONS = [
        'View Admin Dashboard',
        //post permissions
        'View Posts Self',
        'Create Post Self',
        'Edit Post Self',
        'Delete Post Self',
        'Edit Post Other',
        'Delete Post Other',
        'View Posts Other',

        //user permissions
        'Edit User Self',
        'Delete User Self',
        'Change Password Self',
        'View Users Other',
        'Edit User Other',
        'Delete User Other',
        'Change Password Other',

        //role permissions
        'Create Role',
        'Edit Role',
        'Delete Role',
        'View Roles',
        'Change User Role',

        //category Permissions
        'Create Category',
        'View Category Posts',
        'Edit Category',
        'Delete Category',
        'View Categories',


    ];
    public function roles()
    {
        return $This->belongsToMany(Role::class);
    }
}
