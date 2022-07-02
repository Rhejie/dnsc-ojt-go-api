<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = [
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'role_id' => 1,
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' =>  Hash::make('pa55w0rd!')
            ],
            [
                'firstname' => 'institute',
                'lastname' => 'institute',
                'role_id' => 2,
                'username' => 'institute',
                'email' => 'institute@gmail.com',
                'password' =>  Hash::make('pa55w0rd!')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
