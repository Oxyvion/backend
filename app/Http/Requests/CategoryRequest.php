<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /** Solo usuarios con token válido pueden modificar el catálogo. */
    public function authorize(): bool
    {
        // La ruta API ya exige auth:sanctum para cualquier escritura.
        return true;
    }

    /** El nombre requerido debe ser único para evitar categorías repetidas. */
    public function rules(): array
    {
        return [
            // El nombre no se repite; en edición se excluye el registro actual.
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'name')->ignore($this->route('category')),
            ],
        ];
    }
}
