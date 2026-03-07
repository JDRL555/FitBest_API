<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Correo inválido o no existe",
                "status" => 401
            ], 401);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                "success" => false,
                "message" => "Contraseña inválida",
                "status" => 401
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "Iniciaste sesión correctamente",
            "data" => [
                "user" => $user,
                "access_token" => $token,
            ],
            "status" => 200
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "Sesión cerrada correctamente",
            "status" => 204
        ]);
    }
}
