<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'usuario1@gmail.com',
                'password' => bcrypt('usuario1234'),
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [
                'username' => 'usuario2@gmail.com',
                'password' => bcrypt('usuario1234'),
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [
                'username' => 'usuario3@gmail.com',
                'password' => bcrypt('usuario1234'),
                'created_at' => date('Y-m-d H:i:s'),

            ]
        ]);
    }
}
