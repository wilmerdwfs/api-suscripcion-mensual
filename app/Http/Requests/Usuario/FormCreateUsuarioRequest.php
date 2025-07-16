<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class FormCreateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes personalizar según permisos si lo necesitas
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6', // requiere confirmación con password_confirmation
            'confirmarPassword' => 'required|string|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'confirmarPassword.same' => 'La confirmación de la contraseña no coincide.',
        ];
    }
}