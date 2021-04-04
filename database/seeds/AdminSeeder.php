<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'role_id'   => 1,
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('admin@123'),
            'is_active' => 1,
        ]);
    }
}
