<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Support\ApiFormatter;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::with('routine')->get();

        return response()->json(ApiFormatter::response('', 200, $users), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $newUser = $request->validated();

        User::create($newUser);

        return response()->json(ApiFormatter::response('Usuario creado exitosamente!', 201, $newUser), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::with('routine')->find($id);

        $status = !$user ? 404 : 200;
        $message = !$user ? 'Usuario no encontrado' : '';
        return response()->json(ApiFormatter::response($message, $status, $user), $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $updatedUser = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return response()->json(ApiFormatter::response('Usuario no encontrado', 404), 404);
        };

        $user->update($updatedUser);

        return response()->json(ApiFormatter::response('Usuario actualizado exitosamente!', 200, $user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(ApiFormatter::response('Usuario no encontrado', 404), 404);
        };

        $user->delete();

        return response()->json(ApiFormatter::response('Usuario eliminado exitosamente!', 200), 200);
    }
}
