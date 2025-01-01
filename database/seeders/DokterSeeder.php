<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokters = [
            [
                'nama_dokter' => 'Dr. Andi Wijaya',
                'username' => 'andiwijaya',
                'password' => Hash::make('andiwijaya123'), // Ganti sesuai kebutuhan
                'katasandi' => 'andiwijaya123', 
                'alamat' => 'Jl. Kebon Jeruk No. 5, Jakarta',
                'no_hp' => '081234567890',
                'id_poli' => 3, // Asumsikan poli ID 1 sudah ada
                'role' => 'dokter',
            ],
            [
                'nama_dokter' => 'Dr. Siti Aisyah',
                'username' => 'siti_aisyah',
                'password' => Hash::make('siti_aisyah456'), // Ganti sesuai kebutuhan
                'katasandi' => 'siti_aisyah456', 
                'alamat' => 'Jl. Melati Indah No. 12, Bandung',
                'no_hp' => '082345678901',
                'id_poli' => 12, // Asumsikan poli ID 2 sudah ada
                'role' => 'dokter',
            ],
            [
                'nama_dokter' => 'Dr. Budi Santoso',
                'username' => 'budisantoso',
                'password' => Hash::make('budisantoso01'), // Ganti sesuai kebutuhan
                'katasandi' => 'budisantoso01', 
                'alamat' => 'Jl. Pahlawan No. 7, Surabaya',
                'no_hp' => '083456789012',
                'id_poli' => 6, // Asumsikan poli ID 3 sudah ada
                'role' => 'dokter',
            ],
        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}
