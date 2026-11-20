<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\PracticeResultController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    // Este endpoint permite comprobar rápidamente que Laravel está respondiendo.
    return response()->json([
        'status' => 'ok',
        'app' => config('app.name'),
    ]);
});

Route::prefix('v1')->group(function (): void {
    // Registro e inicio son públicos; el límite evita intentos repetidos de contraseña.
    Route::post('/auth/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    // La lectura de categorías y ejercicios es pública para permitir mostrar la biblioteca.
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->whereNumber('category');
    Route::get('/exercises', [ExerciseController::class, 'index']);
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->whereNumber('exercise');

    // Las modificaciones y resultados quedan limitados a la cuenta con token válido.
    Route::middleware('auth:sanctum')->group(function (): void {
        // Las rutas dentro de este grupo exigen un token válido de Sanctum.
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::put('/me', [AuthController::class, 'updateProfile']);
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::apiResource('exercises', ExerciseController::class)->except(['index', 'show']);
        Route::apiResource('practice-results', PracticeResultController::class);
    });
});
