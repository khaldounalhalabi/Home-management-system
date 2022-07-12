<?php

namespace Database\Seeders;

use App\Models\GasConsumption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GasConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GasConsumption::factory()->count(1000)->create();
    }
}
