<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Joshua Rodriguez',
            'username' => 'JDRL',
            'email' => 'josh@josh.com',
            'password' => Hash::make('josh1234'),
            'gender'=> 'M',
            'birth_date' => '2004-06-15',
            'weight_kg' => 63.5,
            'height_m' => 1.77
        ]);
    }
}
