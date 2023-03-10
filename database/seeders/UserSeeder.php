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
        $user = new User();
        $user->name = 'Armando';
        $user->email = 'scrivania.lavoro@gmail.com';
        $user->password = bcrypt('123progetto');
        $user->save();
    }
}
