<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('One23456');
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'Roop Kumar',
                'type' => 'admin',
                'mobile' => "+919876543210",
                'email' => 'kartique79@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ]
        ];
        Admin::insert($adminRecords);
    }
}
