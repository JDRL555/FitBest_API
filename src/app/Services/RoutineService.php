<?php

namespace App\Services;

use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use App\Models\RoutineExercise;

class RoutineService
{
    private static function get($request = null, $id)
    {
        $withExercises = $request ? $request->query('exercises', false) : false;
        $routine = $withExercises ? Routine::with('exercises')->find($id) : Routine::find($id);

        if ($withExercises && $routine) {
            $routine = RoutineResource::make($routine)->resolve();
        }

        return $routine;
    }

    private static function storeDays($request, Routine $routine)
    {
        try {

            $validated = $request->validated();

            $routineExercises = [];

            foreach ($validated['days'] as $day => $exerciseIds) {
                foreach ($exerciseIds as $exerciseId) {
                    $routineExercises[] = [
                        'routine_id' => $routine->id,
                        'exercise_id' => $exerciseId,
                        'day' => $day,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            // Inserción masiva
            if (!empty($routineExercises)) {
                RoutineExercise::insert($routineExercises);
                $routine->exercises()->syncWithoutDetaching(array_column($routineExercises, 'exercise_id'));
            }

            return [
                'success' => true,
                'message' => "Ejercicios asignados exitosamente",
                'data' => $routineExercises
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "Error al asignar ejercicios: " . $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function index($request)
    {
        $withExercises = $request->query('exercises', false);
        $routines = $withExercises ? Routine::with('exercises')->get() : Routine::all();

        if ($withExercises) {
            $routines = RoutineResource::collection($routines)->resolve();
        }

        return $routines;
    }

    public function show($request, $id)
    {
        $routine = self::get($request, $id);

        return $routine;
    }

    public function store($request)
    {
        $validated = $request->validated();

        unset($validated['days']);

        $routine = Routine::create($validated);
        
        $response = self::storeDays($request, $routine);

        if (!$response['success']) {
            return [
                'status' => 400,
                'message' => "Rutina creada pero hubo un error al asignar ejercicios: " . $response['message'],
                'data' => null
            ];
        }

        return [
            'status' => 201,
            'message' => "Rutina creada exitosamente!",
            'data' => $routine
        ];
    }

    public function update($request, $id)
    {
        $routine = self::get($request, $id);

        if (!$routine) {
            return [
                'status' => 404,
                'message' => "Rutina no encontrada",
                'data' => null
            ];
        }

        // Procesar ejercicios por día si existen
        if (!empty($validated['days'])) {
            self::storeDays($request, $routine);
        }

        $routine->update($request->validated());

        return [
            'status' => 200,
            'message' => "Rutina actualizada exitosamente!",
            'data' => $routine
        ];
    }

    public function destroy($id)
    {
        $routine = self::get(null, $id);

        if (!$routine) {
            return [
                'status' => 404,
                'message' => "Rutina no encontrada",
                'data' => null
            ];
        }

        $routine->delete();

        return [
            'status' => 200,
            'message' => "Rutina eliminada exitosamente!",
            'data' => null
        ];
    }
}
