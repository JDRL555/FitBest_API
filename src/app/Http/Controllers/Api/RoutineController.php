<?php

namespace App\Http\Controllers\Api;

use App\Support\ApiFormatter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Routine\StoreRequest;
use App\Http\Requests\Routine\UpdateRequest;

use App\Models\Routine;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $withExercises = $request->query('exercises', false);
        $routine = $withExercises ? Routine::with('exercises')->get() : Routine::all();

        return response()->json(
            ApiFormatter::response('', 200, $routine), 200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $newRoutine = $request->validated();

        Routine::create($newRoutine);
        
        return response()->json(
            ApiFormatter::response('Rutina creada exitosamente!', 201, $newRoutine), 201
        );
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
