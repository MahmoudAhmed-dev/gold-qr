<?php

namespace Database\Factories;

use App\Models\Bar;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarFactory extends Factory
{
    protected $model = Bar::class;

    public function definition()
    {
        $materials = Material::pluck('id')->toArray();

        return [
            'code' => strtoupper($this->faker->numberBetween(000000, 999999)),
            'serial_number' => $this->faker->unique()->numerify('S######'),
            'material_id' => $this->faker->randomElement($materials) ?? null,
            'weight' => $this->faker->numberBetween(50, 5000),
            'fineness' => $this->faker->randomFloat(2, 0, 999.99),
        ];
    }
}
