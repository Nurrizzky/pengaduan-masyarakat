<?php

namespace Database\Seeders;

use App\Models\StaffProvince;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeadStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user baru
        $user = User::create([
            'email' => 'headstaff_jabar@example.com', // Pastikan format email valid
            'role' => 'head_staff',
            'password' => bcrypt('jawabarat'), // Password di-hash
        ]);

        // Mengambil ID user
        $userId = $user->id;

        // Membuat entri di staff_provinces
        StaffProvince::create([
            'user_id' => $userId,
            'province' => 'Jawa Barat',
        ]);
    }
}
