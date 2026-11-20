<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Convierte una categoría Eloquent al JSON que consume React.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Identificador usado en las relaciones y en las rutas de edición.
            'id' => $this->id,
            'name' => $this->name,
            // El contador solo está presente cuando el controlador pidió withCount.
            'exercises_count' => $this->exercises_count,
        ];
    }
}
