<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
        [
            'name' => 'Klark Kent',
            'role' => 'user',
            'email' => 'klark@dailyglobe.com',
            'password' => Hash::make('superman'),
        ],
        [
            'name' => 'Bruce Wayne',
            'role' => 'user',
            'email' => 'wayne@wayneent.com',
            'password' => Hash::make('batman'),
        ],
        [
            'name' => 'Admin 1',
            'role' => 'admin',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('admin'),
        ],
        [
            'name' => 'Admin 2',
            'role' => 'admin',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin'),
        ],
        [
            'name' => 'Tony Stark',
            'role' => 'user',
            'email' => 'tony@starkent.com',
            'password' => Hash::make('ironman'),
        ] ]);
    }
}
