<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::DEFAULT_ROLES as $name => $permissions) {
            $role = Role::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
            foreach ($permissions as $permission) {
                $permissionId = Permission::whereName($permission)->value('id');
                $role->permissions()->attach($permissionId);
            }
        }
    }
}
