<?php

namespace App\Http\Requests\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'planId' => 'required|integer|exists:planes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombreEmpresa.required' => 'El nombre de la empresa es obligatorio.',
            'planId.required' => 'Debe seleccionar un plan.',
            'planId.exists' => 'El plan seleccionado no existe.',
        ];
    }
}