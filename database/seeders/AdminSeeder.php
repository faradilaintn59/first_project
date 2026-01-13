<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Administrator',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'alamat' => 'Kantor Pusat TokoKu',
            'telepon' => '08123456789'
        ]
    );
}
}
