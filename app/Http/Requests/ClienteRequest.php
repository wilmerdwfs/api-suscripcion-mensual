<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombre'         => 'required|string|max:100',
            'contacto'       => 'required|string|max:200',
            'email'          => 'required|email|max:100',
            'telefono'       => 'nullable|string|max:20',
            'sitio_web'      => 'nullable|url|max:300',
            'industria'      => 'nullable|integer|min:1',
            'tamano_empresa' => 'nullable|integer|min:1',
            'localidad'      => 'nullable|string|max:100',
            'direccion'      => 'nullable|string|max:255',
            'notas'          => 'nullable|string',
           // 'origen'         => 'required|in:0,1' // 0 = sistema, 1 = externo
        ];
    }
}