<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /** El registro es público; Laravel aplica aquí la validación antes del controlador. */
    public function authorize(): bool
    {
        // El registro es público; el endpoint limita los intentos por minuto.
        return true;
    }

    /** Define las reglas de nombre, correo único y contraseña confirmada. */
    public function rules(): array
    {
        return [
            // Laravel valida estos datos antes de que AuthController cree al usuario.
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
