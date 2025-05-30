<?php

namespace Database\Seeders;


use App\Models\Kategoris;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'foto' => null
        ]);
        User::factory()->create([
            'name' => 'ilhan',
            'email' => 'ilhan@gmail.com',
            'username' => 'ilhan',
            'password' => Hash::make('ilhan'),
            'role' => 'finance',
            'foto' => null
        ]);
        User::factory()->create([
            'name' => 'janggar',
            'email' => 'janggar@gmail.com',
            'username' => 'janggar',
            'password' => Hash::make('janggar'),
            'role' => 'gudang',
            'foto' => null
        ]);
        Profile::factory()->create();
        Kategoris::factory()->create();
    }
}
