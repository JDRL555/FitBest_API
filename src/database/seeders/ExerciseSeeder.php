<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // base exercises for example
        Exercise::create([
            'name' => 'Flexiones',
            'description' => 'Ejercicio de peso corporal que trabaja el pecho, los hombros y los tríceps.',
            'category' => 'push',
            'equipment_type' => 'bodyweight',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Push-Ups_600x600.png?v=1640121436',
        ]);
        Exercise::create([
            'name' => 'Dominadas',
            'description' => 'Ejercicio de peso corporal que trabaja la espalda y algo de biceps.',
            'category' => 'pull',
            'equipment_type' => 'bodyweight',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Pull-Up_600x600.png?v=1619977612',
        ]);
        Exercise::create([
            'name' => 'Sentadillas con barra libre',
            'description' => 'Ejercicio que trabaja las piernas y los glúteos.',
            'category' => 'legs',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Squat_d752e42d-02ba-4692-b300-c6e67ad5a4f5_600x600.png?v=1612138811',
        ]);

        // my routine exercises
        Exercise::create([
            'name' => 'Press en banca',
            'description' => 'Ejercicio que trabaja el pecho, los hombros y los tríceps.',
            'category' => 'push',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Barbell-Bench-Press_0316b783-43b2-44f8-8a2b-b177a2cfcbfc_600x600.png?v=1612137800',
        ]);

        Exercise::create([
            'name' => 'Press inclinado en barra',
            'description' => 'Ejercicio que trabaja el pecho alto, los hombros y los tríceps.',
            'category' => 'push',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Incline-Barbell-Bench-Press_dc0c6279-d038-44f5-a682-54c2a5e2602c_600x600.png?v=1612137944',
        ]);

        Exercise::create([
            'name' => 'Aperturas en maquina',
            'description' => 'Ejercicio que trabaja el pecho de manera mas aislada.',
            'category' => 'push',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Peck-Deck_600x600.png?v=1612137910',
        ]);

        Exercise::create([
            'name' => 'Elevaciones laterales en polea',
            'description' => 'Ejercicio con enfoque en hombros, especificamente en los deltoides laterales.',
            'category' => 'push',
            'equipment_type' => 'cable',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Cable-One-Arm-Lateral-Raise_3e57189f-cdf3-46ee-9a89-6ca054eae56a_600x600.png?v=1612138775',
        ]);

        Exercise::create([
            'name' => 'Rompecraneos con barra Z',
            'description' => 'Ejercicio con enfoque en triceps, para mayor estimulacion en la cabeza larga.',
            'category' => 'push',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Seated-Barbell-French-Press_600x600.png?v=1619978038',
        ]);

        Exercise::create([
            'name' => 'Extensiones de triceps en polea alta',
            'description' => 'Ejercicio con enfoque en triceps, para mayor estimulacion en la cabeza corta.',
            'category' => 'push',
            'equipment_type' => 'cable',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Single-Arm-Cable-Triceps-Extension-with-Supinated-Grip_600x600.png?v=1619978117',
        ]);

        Exercise::create([
            'name' => 'Sentadilla en maquina hack',
            'description' => 'Ejercicio con enfoque en cuadriceps que tambien trabaja gluteos.',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Hack-Squat_044b3d09-ffa7-4728-b56f-f4fb3c175548_600x600.png?v=1612139060',
        ]);

        Exercise::create([
            'name' => 'Extension de cuadriceps en maquina',
            'description' => 'Ejercicio con aislamiento en cuadriceps',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Leg-Extension_41d91d3f-4b9c-4374-82e2-1d697ce35fe4_600x600.png?v=1612138862',
        ]);

        Exercise::create([
            'name' => 'Aductores en maquina',
            'description' => 'Ejercicio con aislamiento en aductores',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://as1.ftcdn.net/jpg/04/44/66/88/1000_F_444668892_Ozw8mAp712xF330ap4kJ8pVxlyHHzNOa.jpg',
        ]);

        Exercise::create([
            'name' => 'Jalon al pecho con agarre neutro',
            'description' => 'Ejercicio con enfoque en espalda, que tambien trabaja biceps y antebrazos.',
            'category' => 'pull',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Close-Grip-Pulldown_072bb5ce-e3d9-4007-b8d2-d343e9d1051b_600x600.png?v=1612138178',
        ]);

        Exercise::create([
            'name' => 'Remo horizontal unilateral',
            'description' => 'Ejercicio con enfoque en espalda alta, que tambien trabaja biceps y trapecios.',
            'category' => 'pull',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://fitcron.com/wp-content/uploads/2021/04/13501301-Lever-Seated-Row_Back_720.gif',
        ]);

        Exercise::create([
            'name' => 'Remo vertical unilateral',
            'description' => 'Ejercicio con enfoque en dorsales, que tambien trabaja biceps y antebrazos.',
            'category' => 'pull',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://fitcron.com/wp-content/uploads/2021/04/12041301-Cable-one-arm-lat-pulldown_back_720.gif',
        ]);

        Exercise::create([
            'name' => 'Curl predicador con barra Z',
            'description' => 'Ejercicio con enfoque en biceps, especificamente en la cabeza corta.',
            'category' => 'pull',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/EZ-Barbell-Preacher-Curl_4d449fee-1920-4137-970c-75d4698b268d_600x600.png?v=1612137254',
        ]);

        Exercise::create([
            'name' => 'Curl martillo',
            'description' => 'Ejercicio con enfoque en biceps, especificamente en el braquiorradial.',
            'category' => 'pull',
            'equipment_type' => 'dumbbell',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Hammer-Curl_da9fea8b-fc81-4a4f-9af1-aea1b85239d7_600x600.png?v=1612137282',
        ]);

        Exercise::create([
            'name' => 'Curl bayesian',
            'description' => 'Ejercicio con enfoque en biceps, especificamente en la cabeza larga.',
            'category' => 'pull',
            'equipment_type' => 'cable',
            'image_reference_url' => 'https://api.smartworkout.app/asset/image/6e50cd8a-289f-4252-b9fd-32127b60cd1f',
        ]);

        Exercise::create([
            'name' => 'Curl invertido en polea',
            'description' => 'Ejercicio con enfoque en antebrazos.',
            'category' => 'pull',
            'equipment_type' => 'cable',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Seated-Barbell-Wrist-Extension_600x600.png?v=1619978327',
        ]);

        Exercise::create([
            'name' => 'Curl invertido en polea con agarre supinado',
            'description' => 'Ejercicio con enfoque en antebrazos.',
            'category' => 'pull',
            'equipment_type' => 'cable',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Seated-Barbell-Wrist-Curl_600x600.png?v=1619978365',
        ]);

        Exercise::create([
            'name' => 'Peso muerto con barra',
            'description' => 'Ejercicio para trabajar femoral y gluteos.',
            'category' => 'legs',
            'equipment_type' => 'bar',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Barbell-Romanian-Deadlift_34ede1b4-63ac-451d-9536-bbf9942b560c_600x600.png?v=1621162957',
        ]);

        Exercise::create([
            'name' => 'Hip trust en maquina',
            'description' => 'Ejercicio para trabajar gluteos.',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Smith-Machine-Hip-Thrust_600x600.png?v=1656402282',
        ]);

        Exercise::create([
            'name' => 'Extensiones de femoral sentado en maquina',
            'description' => 'Ejercicio para aislar femoral.',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://static.strengthlevel.com/images/exercises/seated-leg-curl/seated-leg-curl-800.jpg',
        ]);

        Exercise::create([
            'name' => 'Abductores en maquina',
            'description' => 'Ejercicio para aislar abductores.',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Seated-Hip-Abduction-Machine_600x600.png?v=1656405168',
        ]);

        Exercise::create([
            'name' => 'Elevaciones de pantorrillas de pie en maquina',
            'description' => 'Ejercicio para aislar gemelos.',
            'category' => 'legs',
            'equipment_type' => 'machine',
            'image_reference_url' => 'https://cdn.shopify.com/s/files/1/0269/5551/3900/files/Standing-Calf-Raise_61746b47-98aa-49ee-bb97-5a19562592b9_600x600.png?v=1612137090',
        ]);
    }
}
