<?php

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoutineController;

use Illuminate\Support\Facades\Route;

$default_api_routes = ['index', 'show', 'store', 'update', 'destroy'];

// Prefix to create a route group. in this case, /exercises/ , /exercises/3, etc
// Route::prefix("exercises")->group(function () {
//     Route::get("/", [ExerciseController::class, "get"]);
//     Route::get("/{id}", [ExerciseController::class, "show"]);
//     Route::post("/", [ExerciseController::class, "create"]);
// });

// Auth endpoint
Route::post('/login', [AuthController::class, 'login'])->name("login");

Route::middleware("auth:sanctum")->group(function () use ($default_api_routes) {
    
    // Auth endpoint
    Route::post('/logout', [AuthController::class, 'logout'])->name("logout");

    // CRUD and main endpoints
    Route::resource('users', UserController::class)->only($default_api_routes);
    Route::resource('exercises', ExerciseController::class)->only($default_api_routes);
    Route::resource('routines', RoutineController::class)->only($default_api_routes);

});