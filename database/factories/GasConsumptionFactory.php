<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GasConsumption>
 */
class GasConsumptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'consumption_per_day' =>  $this->faker->numberBetween(10, 50),
            'date' => $this->faker->date('Y_m_d'),
            'cost' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
