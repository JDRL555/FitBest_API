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
            4 => ['day' => 'monday'],
            5 => ['day' => 'monday'],
            6 => ['day' => 'monday'],
            7 => ['day' => 'monday'],
            8 => ['day' => 'monday'],
            9 => ['day' => 'monday'],
            10 => ['day' => 'tuesday'],
            11 => ['day' => 'tuesday'],
            12 => ['day' => 'tuesday'],
            13 => ['day' => 'wednesday'],
            14 => ['day' => 'wednesday'],
            15 => ['day' => 'wednesday'],
            16 => ['day' => 'wednesday'],
            17 => ['day' => 'wednesday'],
            18 => ['day' => 'wednesday'],
            19 => ['day' => 'wednesday'],
            20 => ['day' => 'wednesday'],
            21 => ['day' => 'thursday'],
            22 => ['day' => 'thursday'],
            23 => ['day' => 'thursday'],
            24 => ['day' => 'thursday'],
            25 => ['day' => 'thursday'],
            4 => ['day' => 'friday'],
            5 => ['day' => 'friday'],
            6 => ['day' => 'friday'],
            26 => ['day' => 'friday'],
            8 => ['day' => 'friday'],
            9 => ['day' => 'friday'],
            19 => ['day' => 'friday'],
            20 => ['day' => 'friday'],
        ]);
    }
}
