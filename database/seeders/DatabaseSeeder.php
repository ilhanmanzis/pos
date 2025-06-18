<?php

namespace Database\Seeders;


use App\Models\Kategoris;
use App\Models\Pelanggans;
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

        $pelanggans = [
            [
                'kode_pelanggan' => '00001',
                'name' => 'Rs. Akbar',
                'no_hp' => '087865467576',
                'email' => 'akbar@gmail.com',
                'alamat' => 'Jl. Tegal Asri Rt 01, Rw 01',
                'desa' => 'Tamanan',
                'kecamatan' => 'Banguntapan',
                'kabupaten' => 'Bantul',
                'provinsi' => 'Daerah Istimewa Yogyakarta'
            ],
            [
                'kode_pelanggan' => '00002',
                'name' => 'Rs. Kardinah',
                'no_hp' => '087865467576',
                'email' => 'admin@gmail.com',
                'alamat' => 'Jl. Tegal Asri Rt 01, Rw 01',
                'desa' => 'Tamanan',
                'kecamatan' => 'Banguntapan',
                'kabupaten' => 'Bantul',
                'provinsi' => 'Daerah Istimewa Yogyakarta'
            ],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggans::factory()->create($pelanggan);
        }
    }
}
