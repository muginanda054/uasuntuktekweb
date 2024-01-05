<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
            'name'      => 'Fika Ridaul Maulayya',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
            'is_admin'  => true
            ],
            [
            'name'      => 'mugi Nanda',
            'email'     => 'user@gmail.com',
            'password'  => bcrypt('password'),
            'is_admin'  => false 
            ]
        ];
        User::insert($data);
    }
}
