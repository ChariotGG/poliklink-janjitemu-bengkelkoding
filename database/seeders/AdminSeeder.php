<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;
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
        Admin::create([
            'name' => 'Admin Name',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // set your desired password
            'role' => 'admin',
        ]);
    }
}
