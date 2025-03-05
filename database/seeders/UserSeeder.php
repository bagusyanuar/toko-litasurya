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
            'id' => '115f8c30-2b34-4f23-8beb-70f783a2424c',
            'username' => 'superadmin',
            'password' => bcrypt('superadmin')
        ];
        User::updateOrCreate($data);
    }
}
