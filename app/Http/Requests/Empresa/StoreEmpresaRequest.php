<?php

namespace App\Http\Requests\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes personalizar esta lógica según permisos
        return true;
    }

    public function rules(): array
    {
        return [
            'nombreEmpresa' => 'required|string|max:255',
            'planId' => 'required|integer|exists:planes,id',//consulta la base de datos
            'nombreUsuario' => 'required|string|max:255',
            'emailUsuario' => 'required|email|max:255|unique:usuarios,email',
            'passwordUsuario' => 'required|string|min:6',
            'confirmarPassword' => 'required|string|same:passwordUsuario',
        ];
    }

    public function messages(): array
    {
        return [
            'nombreEmpresa.required' => 'El nombre de la empresa es obligatorio.',
            'planId.required' => 'Debe seleccionar un plan.',
            'planId.exists' => 'El plan seleccionado no existe.',
            'emailUsuario.unique' => 'Este correo electrónico ya está en uso.',
            'confirmarPassword.same' => 'La confirmación de la contraseña debe coincidir con la contraseña.', 
        ];
    }
}