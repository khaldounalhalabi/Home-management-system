<?php

namespace Database\Seeders;

use App\Models\GasConsumption;
use App\Models\GasSensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(ConsumptionSeeder::class);
        $this->call(GasConsumption::class);
        $this->call(GasSensorSeeder::class);
        $this->call(InterrupterSeeder::class);
        $this->call(SensorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WaterConsumptionSeeder::class);
        $this->call(WaterSensorSeeder::class);
    }
}
