<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Master Administrator',
                'username' => 'akimilakuo',
                'password' => Hash::make('akimilakuo'),
                'token' => null,
                'level' => '0',
                'status' => null,
                'vote_time' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Common Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'token' => null,
                'level' => '1',
                'status' => null,
                'vote_time' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mohammad Farid Hasymi',
                'username' => '1216005',
                'password' => Hash::make('THQ8WUW72O'),
                'token' => 'THQ8WUW72O',
                'level' => '2',
                'status' => '0',
                'vote_time' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
