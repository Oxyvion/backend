<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePracticeResultRequest extends FormRequest
{
    /** Las rutas de resultados requieren autenticación de Sanctum. */
    public function authorize(): bool
    {
        // El grupo de rutas limita esta petición al usuario autenticado.
        return true;
    }

    /** Valida el texto, ejercicio y tiempo antes del cálculo de resultados. */
    public function rules(): array
    {
        return [
            // Se verifica el vínculo con la base y los rangos numéricos antes del cálculo.
            'exercise_id' => ['required', 'integer', 'exists:exercises,id'],
            'typed_text' => ['required', 'string', 'max:20000'],
            'elapsed_seconds' => ['required', 'integer', 'min:1', 'max:86400'],
            'mistakes' => ['sometimes', 'integer', 'min:0', 'max:20000'],
        ];
    }
}
