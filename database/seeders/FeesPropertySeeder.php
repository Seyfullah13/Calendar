<?php

namespace Database\Seeders;

use App\Models\FeesProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeesPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeesProperty::factory()->count(10)->create();
    }
}
