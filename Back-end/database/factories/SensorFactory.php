<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'interrupter_status' => $this->faker->numberBetween(0, 1),
            'current_consumption' => $this->faker->numberBetween(10, 100),
            'allowed_consumption' => $this->faker->numberBetween(10, 100),
            'allowed_consumption_cost' => $this->faker->randomFloat(2, 10, 1000),
            'user_id' => $this->faker->unique()->numberBetween(1, 50),
            'start_cut_time' => $this->faker->time('h:m'),
            'end_cut_time' => $this->faker->time('h:m'),
            'current_voltage' => $this->faker->numberBetween(180, 220),
            'start_peak_time' => $this->faker->time('h:m'),
            'end_peak_time' => $this->faker->time('h:m'),
        ];
    }
}
