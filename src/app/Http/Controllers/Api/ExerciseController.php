<?php

namespace App\Http\Controllers\Api;

// Request: rules for it request
use App\Http\Requests\Exercise\StoreRequest;
use App\Http\Requests\Exercise\UpdateRequest;

// Model: persistent data representation by the Eloquent ORM
use App\Models\Exercise;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ExerciseController extends Controller
{
    public function index(): JsonResponse
    {
        $exercises = Exercise::all();

        return response()->json([
            'message' => '',
            'success' => true,
            'data' => $exercises
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $newExercise = $request->validated();

        Exercise::create($newExercise);

        return response()->json([
            'message' => 'Ejercicio creado exitosamente!',
            'success' => true,
            'data' => $newExercise
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        return response()->json([
            'message' => !$exercise ? 'Ejercicio no encontrado' : '',
            'success' => boolval($exercise),
            'data' => $exercise
        ], !$exercise ? 404 : 200);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'message' => 'Ejercicio no encontrado',
                'success' => false,
                'data' => null
            ], 404);
        }

        $exercise->update($request->validated());

        return response()->json([
            'message' => 'Ejercicio actualizado exitosamente!',
            'success' => true,
            'data' => $exercise
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'message' => 'Ejercicio no encontrado',
                'success' => false,
                'data' => null
            ], 404);
        }

        $exercise->delete();

        return response()->json([
            'message' => 'Ejercicio eliminado exitosamente!',
            'success' => true,
            'data' => null
        ], 200);
    }
}
