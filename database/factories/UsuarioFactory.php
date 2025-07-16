<?php

namespace Database\Factories;

use App\Domain\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // password por defecto para pruebas
            'empresa_id' => null, // se debe asignar explícitamente en el test
            'es_admin' => 0,      // por defecto no es admin
        ];
    }
}