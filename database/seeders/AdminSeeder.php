<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Pastiin model Admin dipanggil


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'nama' => 'Muhammad Isya Asyhari',
                'username' => 'mincaw',
                'alamat' => 'Demak',
                'password' => '123', // pakai Hash::make('123') kalau mau di-encrypt
            ],
            [
                'nama' => 'Yesaya Sandya Putra Prabaswara',
                'username' => 'suki',
                'alamat' => 'Sukoharjo',
                'password' => '123',
            ],
            [
                'nama' => 'Nugroho Ghathfaan Rajendra',
                'username' => 'gatra',
                'alamat' => 'Semarang',
                'password' => '123',
            ],
            [
                'nama' => 'Hafiyyan Dimas Walana',
                'username' => 'hafiyyan',
                'alamat' => 'Jakarta', // 
                'password' => '123',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}