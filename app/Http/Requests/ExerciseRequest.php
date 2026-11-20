<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
{
    /** Laravel valida además que esta petición llegue por una ruta autenticada. */
    public function authorize(): bool
    {
        // La protección de acceso se configura en las rutas API.
        return true;
    }

    /** Comprueba título, categoría existente, dificultad y contenido del ejercicio. */
    public function rules(): array
    {
        return [
            // El ejercicio necesita título, categoría válida, dificultad y texto.
            'title' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'difficulty' => ['required', 'string', 'max:40'],
            'content' => ['required', 'string', 'max:20000'],
        ];
    }
}
