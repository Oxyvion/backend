<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Convierte un ejercicio Eloquent al formato JSON de la API.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // category_id permite volver a seleccionar la categoría en el formulario.
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => $this->category_id,
            // La relación se carga en el controlador para incluir el nombre legible.
            'category' => $this->category?->name,
            'difficulty' => $this->difficulty,
            'content' => $this->content,
        ];
    }
}
