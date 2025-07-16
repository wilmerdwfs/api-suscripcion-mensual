<?php

namespace Database\Factories;

use App\Domain\Models\Empresa;
use App\Domain\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'plan_id' =>  Plan::factory(), // <-- esto genera un plan automáticamente, // o usar factory para Plan si quieres
        ];
    }
}