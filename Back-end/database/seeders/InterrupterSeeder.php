<?php

namespace Database\Seeders;

use App\Models\Interrupter;
use Illuminate\Database\Seeder;

class InterrupterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interrupter::factory()->count(300)->create();
    }
}
