<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InterrupterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'room_device' => implode($this->faker->randomElements(['kitchen', 'bedroom', 'living room', 'bathrom', 'refrigerator', 'air conditioner', 'water heater', 'lights', 'first room', 'children room', 'balcony '])),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
