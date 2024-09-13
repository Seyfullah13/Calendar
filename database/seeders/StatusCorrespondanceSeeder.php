<?php

namespace Database\Seeders;

use App\Models\StatusCorrespondance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusCorrespondanceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusCorrespondance::factory()->count(10)->create();

    }
}
