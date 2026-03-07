<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Support\ApiFormatter;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(ApiFormatter::response("Correo inválido o no existe", 401), 401);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(ApiFormatter::response("Contraseña inválida", 401), 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(ApiFormatter::response("Iniciaste sesión correctamente", 200, [
            "user" => $user,
            "access_token" => $token,
        ]), 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(ApiFormatter::response("Sesión cerrada correctamente", 204), 204);
    }
}
