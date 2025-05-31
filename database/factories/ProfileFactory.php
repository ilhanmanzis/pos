<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_profile' => 1,
            'name' => 'PT. Janggar Fals',
            'logo' => 'profile.png',
            'alamat' => 'Kota Yogyakarta, Daerah Istimewa Yogyakarta',
            'no_hp' => '08867567567',
            'email' => 'janggarfals1207@gmail.com',
            'ppn' => 10,
            'nsfp' => '010.002-22.12345678'
        ];
    }
}
