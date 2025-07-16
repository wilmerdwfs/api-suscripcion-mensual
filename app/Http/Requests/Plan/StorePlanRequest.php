<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia a false si quieres controlar permisos
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'precioMensual' => 'required|integer|min:0',
            'limiteUsuarios' => 'required|integer|min:0',
            'caracteristicas' => 'required|integer|min:0',
        ];
    }
}