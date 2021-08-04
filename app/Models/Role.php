<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public const DEFAULT_ROLES = [
        'admin' => Permission::PERMISSIONS,
        'member' => [
            'View Posts Self',
            'Create Post Self',
            'Edit Post Self',
            'Delete Post Self',
            'Edit User Self',
            'Change Password Self',
        ],
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
