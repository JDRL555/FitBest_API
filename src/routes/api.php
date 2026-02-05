<?php

use App\Http\Controllers\Api\ExerciseController;

use Illuminate\Support\Facades\Route;

$default_api_routes = ['index', 'show', 'store', 'update', 'destroy'];

Route::get('/status', function () {
    return response()->json(['status' => 'ok']);
});

// Prefix to create a route group. in this case, /exercises/ , /exercises/3, etc
// Route::prefix("exercises")->group(function () {
//     Route::get("/", [ExerciseController::class, "get"]);
//     Route::get("/{id}", [ExerciseController::class, "show"]);
//     Route::post("/", [ExerciseController::class, "create"]);
// });

// CRUD routes for Exercise resource - In only one route declaration
Route::resource('exercises', ExerciseController::class)->only($default_api_routes);