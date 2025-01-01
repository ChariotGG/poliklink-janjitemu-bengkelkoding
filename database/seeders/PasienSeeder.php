<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama'      => 'John Doe',
                'username'  => 'johndoe',
                'alamat'    => 'Jl. Merdeka No. 1, Jakarta',
                'no_ktp'    => '1234567890123456',
                'no_rm'     => '202501-001',
                'password'  => Hash::make('password123'),
                'katasandi' => 'password123',
                'role'      => 'pasien',
            ],
            [
                'nama'      => 'Jane Smith',
                'username'  => 'janesmith',
                'alamat'    => 'Jl. Sudirman No. 10, Bandung',
                'no_ktp'    => '6543210987654321',
                'no_rm'     => '202501-002',
                'password'  => Hash::make('mypassword'),
                'katasandi' => 'mypassword',
                'role'      => 'pasien',
            ],
            [
                'nama'      => 'Alice Brown',
                'username'  => 'alicebrown',
                'alamat'    => 'Jl. Diponegoro No. 20, Surabaya',
                'no_ktp'    => '9876543210123456',
                'no_rm'     => '202501-003',
                'password'  => Hash::make('alicepass'),
                'katasandi' => 'alicepass',
                'role'      => 'pasien',
            ]
        ];

        foreach ($data as $item) {
            Pasien::create($item);
        }
    }
}
