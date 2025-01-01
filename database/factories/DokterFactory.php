<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_dokter' => $this->faker->name,
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'id_poli' => $this->faker->numberBetween(1, 1), // Sesuaikan range dengan data id_poli Anda
            'username' => 'Yoga',
            'katasandi' => 'Semarang',
            'password' => bcrypt('Semarang'), // Anda bisa mengganti dengan password default
            'role' => $this->faker->randomElement(['admin', 'dokter', 'staff']),
        ];
    }
}
