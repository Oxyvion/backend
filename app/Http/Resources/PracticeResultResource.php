<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PracticeResultResource extends JsonResource
{
    /**
     * Presenta los datos del resultado sin exponer información de otras cuentas.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // El frontend usa exercise_id al editar y exercise_title para mostrarlo.
            'id' => $this->id,
            'exercise_id' => $this->exercise_id,
            'exercise_title' => $this->exercise?->title,
            'typed_text' => $this->typed_text,
            'elapsed_seconds' => $this->elapsed_seconds,
            'ppm' => $this->ppm,
            // Se castea a número para que React pueda formatearlo como porcentaje.
            'accuracy' => (float) $this->accuracy,
            'errors' => $this->errors,
            'characters_typed' => $this->characters_typed,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
