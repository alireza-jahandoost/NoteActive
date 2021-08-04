<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::PERMISSIONS as $permission) {
            Permission::create([
                'name' => $permission,
                'slug' => Str::slug($permission),
            ]);
        }
    }
}
