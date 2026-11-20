<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /** Solo se acepta esta petición dentro de las rutas privadas de Sanctum. */
    public function authorize(): bool
    {
        // La ruta /me está dentro de auth:sanctum, por eso existe un usuario actual.
        return true;
    }

    /** Valida nombre y correo único, excluyendo la cuenta que ya está editándose. */
    public function rules(): array
    {
        return [
            // Solo se permite modificar nombre y correo, nunca el rol de la cuenta.
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
        ];
    }
}
