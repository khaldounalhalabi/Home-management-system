<?php

namespace Database\Seeders;

use App\Models\WaterConsumption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WaterConsumption::factory()->count(1000)->create();
    }

}
