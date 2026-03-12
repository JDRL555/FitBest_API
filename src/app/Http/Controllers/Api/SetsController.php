<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sets\StoreRequest;
use App\Http\Requests\Sets\UpdateRequest;
use App\Models\RoutineExercise;
use App\Support\ApiFormatter;
use App\Models\Set;
use App\Models\Workout;

class SetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sets = Set::with(['workout', 'exercise'])->get();

        return ApiFormatter::response("", 200, $sets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $workout = Workout::find($validated['workout_id']);

        $exists = RoutineExercise::all()
            ->where('routine_id', $workout->routine_id)
            ->where('exercise_id', $validated['exercise_id'])
            ->first();

        if(!$exists) {
            return response()->json(
                ApiFormatter::response("El ejercicio no está asignado a la rutina correspondiente", 404), 404
            );
        }

        $set = Set::create($validated);

        return ApiFormatter::response("Serie creada exitosamente", 201, $set);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $set = Set::with(['workout', 'exercise'])->get()->where('id', $id)->first();

        $status = !$set ? 404 : 200;
        $message = !$set ? "Serie no encontrada" : "";

        return ApiFormatter::response($message, $status, $set);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $set = Set::find($id);

        if(!$set) {
            return ApiFormatter::response("Serie no encontrada", 404);
        }

        $set->update($request->validated());

        return ApiFormatter::response("Serie actualizada exitosamente", 200, $set);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $set = Set::find($id);

        if(!$set) {
            return ApiFormatter::response("Serie no encontrada", 404);
        }

        $set->delete();

        return ApiFormatter::response("Serie eliminada exitosamente", 200);
    }
}
