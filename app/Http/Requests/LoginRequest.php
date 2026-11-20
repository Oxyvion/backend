<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /** El inicio de sesión es público y protegido por límite de intentos en la ruta. */
    public function authorize(): bool
    {
        // Iniciar sesión debe poder solicitarse sin tener un token previo.
        return true;
    }

    /** Verifica que se envíen correo válido y contraseña. */
    public function rules(): array
    {
        return [
            // Estas reglas revisan formato; AuthController comprueba la contraseña.
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }
}
