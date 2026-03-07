<?php

namespace App\Http\Controllers\Api;

// Request: rules for it request
use App\Http\Requests\Exercise\StoreRequest;
use App\Http\Requests\Exercise\UpdateRequest;

// Model: persistent data representation by the Eloquent ORM
use App\Models\Exercise;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Support\ApiFormatter;

class ExerciseController extends Controller
{
    public function index(): JsonResponse
    {
        $exercises = Exercise::all();

        return response()->json(
            ApiFormatter::response('', 200, $exercises), 200
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $newExercise = $request->validated();

        Exercise::create($newExercise);

        return response()->json(ApiFormatter::response('Ejercicio creado exitosamente!', 201, $newExercise), 201);
    }

    public function show(string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        $status = !$exercise ? 404 : 200;
        $message = !$exercise ? 'Ejercicio no encontrado' : '';
        return response()->json(ApiFormatter::response($message, $status, $exercise), $status);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(ApiFormatter::response('Ejercicio no encontrado', 404), 404);
        }

        $exercise->update($request->validated());

        return response()->json(ApiFormatter::response('Ejercicio actualizado exitosamente!', 200, $exercise), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(ApiFormatter::response('Ejercicio no encontrado', 404), 404);
        }

        $exercise->delete();

        return response()->json(ApiFormatter::response('Ejercicio eliminado exitosamente!', 200), 200);
    }
}
