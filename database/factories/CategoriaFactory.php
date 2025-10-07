<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'estado' => $this->faker->boolean(80), // 80% chance true
            'fecha_creacion' => $this->faker->date(),
            'prioridad' => $this->faker->numberBetween(1, 10),
        ];
    }
}
