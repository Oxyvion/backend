<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** Valida, crea la cuenta y devuelve un token Sanctum para la nueva sesión. */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return response()->json(['data' => [
            'user' => $user,
            'token' => $user->createToken('electiva-ii')->plainTextToken,
        ]], 201);
    }

    /** Compara la contraseña cifrada y emite el token que usará React. */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Correo o contraseña incorrectos.'], 401);
        }

        return response()->json(['data' => [
            'user' => $user,
            'token' => $user->createToken('electiva-ii')->plainTextToken,
        ]]);
    }

    /** Revoca el token de esta sesión sin cerrar otras sesiones de la cuenta. */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Sesión cerrada.']);
    }

    /** Devuelve los datos públicos de la cuenta; el modelo oculta la contraseña. */
    public function me(Request $request): JsonResponse
    {
        return response()->json(['data' => $request->user()]);
    }

    /** Actualiza el nombre y el correo de la cuenta autenticada. */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json(['data' => $user->refresh()]);
    }
}
