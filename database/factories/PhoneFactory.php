<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'phone_brand' => $this->faker->company(),
            'phone_model' => $this->faker->word(),
            'phone_price' => $this->faker->randomFloat(2, 100, 1000),
            'phone_display_size' => $this->faker->numberBetween(3, 10),
            'phone_is_smartphone' => $this->faker->boolean(),
            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? null,
            'codigo_barras' => $this->faker->bothify('?#?#?#?#?#?'), // cadena aleatoria ejemplo
        ];
    }
}
