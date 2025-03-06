<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => '115f8c30-2b34-4f23-8beb-70f783a2424c',
                'username' => 'superadmin',
                'role' => 'superadmin',
                'password' => bcrypt('superadmin')
            ],
            [
                'id' => '4c0246e6-ce88-4034-9c43-05f211638316',
                'username' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('admin')
            ],
            [
                'id' => 'c4a6aa3c-a4c6-4d57-b061-3f753ba9a4ff',
                'username' => 'sales',
                'role' => 'sales',
                'password' => bcrypt('sales')
            ]
        ];
        foreach ($data as $datum) {
            User::updateOrCreate($datum);
        }
    }
}
