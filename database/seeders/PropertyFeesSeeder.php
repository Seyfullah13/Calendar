<?php

namespace Database\Seeders;

use App\Models\PropertyFees;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyFees::factory()->count(10)->create();

    }
}
