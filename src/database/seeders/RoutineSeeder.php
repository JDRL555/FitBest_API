<?php

namespace Database\Seeders;

use App\Models\Routine;
use Illuminate\Database\Seeder;

class RoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routine = Routine::create([
            'name' => 'Rutina para volumen',
            'description' => 'Rutina enfocada en ganar masa muscular.',
            'current_routine' => true,
            'user_id' => 1
        ]);

        $routine->exercises()->attach([
            4,5,6,7,8,9,10,
            11,12,13,14,15,16,17,18,19,20,
            21,22,23,24,25
        ]);
    }
}
