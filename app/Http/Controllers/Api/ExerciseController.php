<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExerciseController extends Controller
{
    /** Devuelve ejercicios ordenados e incluye la relación con su categoría. */
    public function index(): AnonymousResourceCollection
    {
        return ExerciseResource::collection(
            Exercise::query()->with('category')->orderBy('category_id')->orderBy('id')->get(),
        );
    }

    /** Busca un ejercicio por id y agrega el nombre de su categoría. */
    public function show(Exercise $exercise): ExerciseResource
    {
        return new ExerciseResource($exercise->load('category'));
    }

    /** Valida los cuatro campos y guarda un ejercicio. */
    public function store(ExerciseRequest $request): JsonResponse
    {
        $exercise = Exercise::query()->create($request->validated());

        return response()->json(['data' => new ExerciseResource($exercise->load('category'))], 201);
    }

    /** Reemplaza los datos editables del ejercicio seleccionado. */
    public function update(ExerciseRequest $request, Exercise $exercise): ExerciseResource
    {
        $exercise->update($request->validated());

        return new ExerciseResource($exercise->load('category'));
    }

    /** Elimina el ejercicio; MySQL elimina en cascada sus resultados asociados. */
    public function destroy(Exercise $exercise): JsonResponse
    {
        // La clave foránea exercise_id tiene ON DELETE CASCADE en la migración.
        $exercise->delete();

        return response()->json(['message' => 'Ejercicio eliminado.']);
    }
}
