<?php

namespace Database\Seeders;

use App\Models\Consumption;
use Illuminate\Database\Seeder;

class ConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consumption::factory()->count(1000)->create();
    }
}
