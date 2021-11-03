<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();

        $data = [
            [
                'name' => 'Farid Azhar Kusuma',
                'username' => 'farid',
                'email' => 'farid@test.com',
                'password' => Hash::make('111222333'),
                'role_id' => 1,
                'email_verified_at' => date('Y-m-d h:i:s', time()),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
            [
                'name' => 'Fauzia Azizah Kusuma',
                'username' => 'fauzia',
                'email' => 'fauzia@test.com',
                'password' => Hash::make('111222333'),
                'role_id' => 2,
                'email_verified_at' => date('Y-m-d h:i:s', time()),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
            [
                'name' => 'Dwi Tyastuti',
                'username' => 'dwityastuti',
                'email' => 'dwityastuti@test.com',
                'password' => Hash::make('111222333'),
                'role_id' => 3,
                'email_verified_at' => date('Y-m-d h:i:s', time()),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
            [
                'name' => 'Fairiza Azmi Kusuma',
                'username' => 'fairiza',
                'email' => 'fairiza@test.com',
                'password' => Hash::make('111222333'),
                'role_id' => 4,
                'email_verified_at' => date('Y-m-d h:i:s', time()),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
            [
                'name' => 'Fairizky Azrul Kusuma',
                'username' => 'fairizky',
                'email' => 'fairizky@test.com',
                'password' => Hash::make('111222333'),
                'role_id' => 7,
                'email_verified_at' => date('Y-m-d h:i:s', time()),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ],
        ];

        User::insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
