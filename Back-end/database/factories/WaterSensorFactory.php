<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaterSensor>
 */
class WaterSensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'current_consumption' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->numberBetween(0, 1),
            'start_cut_time' => $this->faker->time('h:m'),
            'end_cut_time' => $this->faker->time('h:m'),
            'user_id' => $this->faker->unique()->numberBetween(1, 50),
        ];
    }
}
