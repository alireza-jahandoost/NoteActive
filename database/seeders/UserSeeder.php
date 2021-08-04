<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'role_id' => 1,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$eCSzm5b6I47MU06eRXgArONtVzWc0FnIDQ2II.xKT48GrUj2uIFRq', // admin
        ]);
    }
}
