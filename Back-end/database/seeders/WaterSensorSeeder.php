<?php

namespace Database\Seeders;

use App\Models\WaterSensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WaterSensor::factory()->count(50)->create();
    }
}
