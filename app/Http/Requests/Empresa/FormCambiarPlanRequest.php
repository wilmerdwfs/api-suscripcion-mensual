<?php

namespace App\Http\Requests\Empresa;

use Illuminate\Foundation\Http\FormRequest;

class FormCambiarPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes personalizar esta lógica según permisos
        return true;
    }

    public function rules(): array
    {
        return [
            'planId' => 'required|integer|exists:planes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'planId.required' => 'Debe seleccionar un plan.',
        ];
    }
}