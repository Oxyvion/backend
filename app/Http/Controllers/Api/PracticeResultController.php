<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticeResultRequest;
use App\Http\Resources\PracticeResultResource;
use App\Models\Exercise;
use App\Models\PracticeResult;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class PracticeResultController extends Controller
{
    /** Devuelve únicamente el historial de la persona que inició sesión. */
    public function index(Request $request): AnonymousResourceCollection
    {
        $results = PracticeResult::query()
            ->whereBelongsTo($request->user())
            ->with('exercise')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return PracticeResultResource::collection($results);
    }

    /** Verifica la práctica, calcula métricas y la guarda ligada al usuario actual. */
    public function store(StorePracticeResultRequest $request): JsonResponse
    {
        $data = $request->validated();
        $exercise = Exercise::query()->findOrFail($data['exercise_id']);
        $result = PracticeResult::query()->create([
            'user_id' => $request->user()->id,
            'exercise_id' => $exercise->id,
            ...$this->practiceMetrics($data['typed_text'], $exercise, $data['elapsed_seconds'], $data['mistakes'] ?? 0),
        ]);

        return response()->json(['data' => new PracticeResultResource($result->load('exercise'))], 201);
    }

    /** Muestra el resultado solo si pertenece al usuario autenticado. */
    public function show(Request $request, PracticeResult $practiceResult): PracticeResultResource
    {
        $this->authorizeOwner($request, $practiceResult);

        return new PracticeResultResource($practiceResult->load('exercise'));
    }

    /** Edita el resultado propio y vuelve a calcular sus métricas en el servidor. */
    public function update(
        StorePracticeResultRequest $request,
        PracticeResult $practiceResult,
    ): PracticeResultResource {
        $this->authorizeOwner($request, $practiceResult);
        $data = $request->validated();
        $exercise = Exercise::query()->findOrFail($data['exercise_id']);

        $practiceResult->update([
            'exercise_id' => $exercise->id,
            ...$this->practiceMetrics($data['typed_text'], $exercise, $data['elapsed_seconds'], $data['mistakes'] ?? 0),
        ]);

        return new PracticeResultResource($practiceResult->load('exercise'));
    }

    /** Elimina el resultado propio sin afectar el ejercicio ni otros usuarios. */
    public function destroy(Request $request, PracticeResult $practiceResult): JsonResponse
    {
        $this->authorizeOwner($request, $practiceResult);
        $practiceResult->delete();

        return response()->json(['message' => 'Práctica eliminada.']);
    }

    /**
     * Cuenta aciertos y errores y calcula el resultado a partir del texto guardado.
     *
     * @return array{typed_text: string, elapsed_seconds: int, ppm: int, accuracy: float, errors: int, characters_typed: int}
     */
    private function practiceMetrics(string $typedText, Exercise $exercise, int $elapsedSeconds, int $mistakes = 0): array
    {
        $typedCharacters = mb_str_split($typedText);
        $targetCharacters = mb_str_split($exercise->content);

        if (count($typedCharacters) !== count($targetCharacters)) {
            throw ValidationException::withMessages([
                'typed_text' => 'Completa todo el texto antes de guardar la práctica.',
            ]);
        }

        $correctCharacters = 0;

        foreach ($typedCharacters as $index => $character) {
            if ($targetCharacters[$index] === $character) {
                $correctCharacters++;
            }
        }

        $charactersTyped = count($typedCharacters);
        $errors = $mistakes + ($charactersTyped - $correctCharacters);
        $accuracy = round(($correctCharacters / ($charactersTyped + $mistakes)) * 100, 2);
        $ppm = (int) round($correctCharacters * 60 / $elapsedSeconds);

        return [
            'typed_text' => $typedText,
            'elapsed_seconds' => $elapsedSeconds,
            'ppm' => $ppm,
            'accuracy' => $accuracy,
            'errors' => $errors,
            'characters_typed' => $charactersTyped,
        ];
    }

    /** Oculta como inexistente cualquier resultado de otra cuenta. */
    private function authorizeOwner(Request $request, PracticeResult $practiceResult): void
    {
        if ((int) $practiceResult->user_id !== (int) $request->user()->id) {
            throw (new ModelNotFoundException)->setModel(PracticeResult::class, [$practiceResult->id]);
        }
    }
}
