<?php

namespace Database\Factories;

use App\Domain\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'precio_mensual' => $this->faker->randomFloat(2, 10, 100),
            'limite_usuarios' => $this->faker->numberBetween(1, 100),
            'caracteristicas' => 0,
        ];
    }
}