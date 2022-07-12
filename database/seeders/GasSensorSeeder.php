<?php

namespace Database\Seeders;

use App\Models\GasSensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GasSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GasSensor::factory()->count(50)->create();
    }
}
