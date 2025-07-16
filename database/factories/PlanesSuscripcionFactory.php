<?php

namespace Database\Factories;

use App\Domain\Models\PlanesSuscripcion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanesSuscripcionFactory extends Factory
{
    protected $model = PlanesSuscripcion::class;

    public function definition()
    {
        return [
            'empresa_id' => 1, // puedes cambiar a un valor válido en el test o hacer override al crear
            'plan_anterior_id' => 1,
            'plan_nuevo_id' => 1,
            'estado' => 0,
            'fecha' => $this->faker->date(),
        ];
    }
}