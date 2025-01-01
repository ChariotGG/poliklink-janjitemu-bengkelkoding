<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',  // Menetapkan role admin
        ]);
        

        Dokter::factory()->create([
            'nama_dokter' => 'Dr. John Doe',
            'alamat' => 'Jl. Raya No. 123, Jakarta',
            'no_hp' => '081234567890',
            'id_poli' => 1, // Contoh id_poli
            'username' => 'yoga',
            'katasandi' => 'yoga123',
            'password' => bcrypt('yoga123'),
            'role' => 'admin',  // Menetapkan role admin untuk dokter
        ]);
        
    }
}
