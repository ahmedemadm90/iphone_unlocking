<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            'role_name'=>'admin'
        ]);
        Role::create([
            'role_name'=>'user'
        ]);


        User::create([
            'name' => 'FRP Admin',
            'email' => 'admin@frp.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'country' => 'Egypt',
            'phone' => '+201019030515',
        ]);
        User::create([
            'name' => 'FRP User',
            'email' => 'user@frp.com',
            'password' => Hash::make('123456'),
            'role_id' => 2,
            'country' => 'Egypt',
            'phone' => '+201000803545',
        ]);
    }
}
