<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\StoreRequest;
use App\Http\Requests\Workout\UpdateRequest;
use App\Models\Workout;
use App\Support\ApiFormatter;
use DateTime;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::with(["user", "routine", "sets.exercise"])->get();

        return response()->json(ApiFormatter::response("", 200, $workouts), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $new_workout = $request->validated();

        $start_date = DateTime::createFromFormat('Y-m-d H:i', $new_workout['start_at']);
        $end_date = DateTime::createFromFormat('Y-m-d H:i', $new_workout['end_at']);

        if($start_date->format('Y-m-d') != $end_date->format('Y-m-d')) {
            return response()->json(
                ApiFormatter::response("Las fechas del entrenamiento deben ser el mismo dia", 400), 400
            );
        }

        $workout = Workout::create($new_workout);

        return response()->json(ApiFormatter::response("Workout created successfully!", 201, $workout), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(ApiFormatter::response("Workout not found", 404), 404);
        }

        return response()->json(ApiFormatter::response("", 200, $workout), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(ApiFormatter::response("Workout not found", 404), 404);
        }

        $workout->update($request->all());

        return response()->json(ApiFormatter::response("Workout updated successfully!", 200, $workout), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(ApiFormatter::response("Workout not found", 404), 404);
        }

        $workout->delete();
    }
}
