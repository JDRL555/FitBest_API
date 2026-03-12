<?php

namespace App\Http\Controllers\Api;

use App\Support\ApiFormatter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routine\StoreRequest;
use App\Http\Requests\Routine\UpdateRequest;

use App\Models\Routine;
use App\Models\RoutineExercise;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoutineController extends Controller
{

    private function groupRoutineExercises($routines, bool $isSingle = false)
    {
        // Si es un solo objeto (find), lo metemos en una colección temporal para procesarlo igual
        $collection = $isSingle ? collect([$routines]) : $routines;

        $collection->each(function ($routine) {
            if ($routine->relationLoaded('exercises')) {
                $grouped = $routine->exercises->groupBy('id')->map(function ($group) {
                    $exercise = $group->first();

                    // Agregamos el array de días y limpiamos el pivot individual
                    $exercise->days = $group->pluck('pivot.day')->unique()->values();
                    unset($exercise->pivot);

                    return $exercise;
                })->values();

                $routine->setRelation('exercises', $grouped);
            }
        });

        return $isSingle ? $collection->first() : $collection;
    }

    private function storeDays($request, Routine $routine)
    {
        try {

            $validated = $request->validated();

            $routineExercises = [];

            foreach ($validated['days'] as $day => $exerciseIds) {
                // Validar día
                if (!in_array($day, ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])) {
                    return [
                        'inserted' => false,
                        'message' => "Día inválido",
                        'data' => null
                    ];
                }

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
                'inserted' => true,
                'message' => "Ejercicios asignados exitosamente",
                'data' => $routineExercises
            ];
        } catch (\Exception $e) {
            return [
                'inserted' => false,
                'message' => "Error al asignar ejercicios: " . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $withExercises = $request->query('exercises', false);
        $routines = $withExercises ? Routine::with('exercises')->get() : Routine::all();

        if ($withExercises) {
            $routines = $this->groupRoutineExercises($routines);
        }

        return response()->json(
            ApiFormatter::response('', 200, $routines),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        unset($validated['days']);

        $routine = Routine::create($validated);

        // Procesar ejercicios por día si existen
        $response = $this->storeDays($request, $routine);

        if (!$response['inserted']) {
            return response()->json(ApiFormatter::response($response['message'], 400, $routine), 400);
        }

        return response()->json(ApiFormatter::response('Rutina creada exitosamente!', 201, $routine), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $withExercises = $request->query('exercises', false);
        $routine = $withExercises ? Routine::with('exercises')->find($id) : Routine::find($id);

        $status = !$routine ? 404 : 200;
        $message = !$routine ? 'Rutina no encontrada' : '';

        if ($withExercises && $routine) {
            $routine = $this->groupRoutineExercises($routine, true);
        }

        return response()->json(ApiFormatter::response($message, $status, $routine), $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $routine = Routine::find($id);

        if (!$routine) {
            return response()->json(ApiFormatter::response('Rutina no encontrada', 404), 404);
        }

        $routine->update($request->validated());

        // Procesar ejercicios por día si existen
        if (!empty($validated['days'])) {
            $this->storeDays($request, $routine);
        }

        return response()->json(ApiFormatter::response('Rutina actualizada exitosamente!', 200, $routine), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $routine = Routine::find($id);

        if (!$routine) {
            return response()->json(ApiFormatter::response('Rutina no encontrada', 404), 404);
        }

        $routine->delete();

        return response()->json(ApiFormatter::response('Rutina eliminada exitosamente!', 200), 200);
    }
}
