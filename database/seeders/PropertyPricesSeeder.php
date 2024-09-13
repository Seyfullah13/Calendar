<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertyPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 20 random price records
        for ($i = 0; $i < 20; $i++) {
            DB::table('property_prices')->insert([
                'property_id' => rand(1, 10), // Random property_id between 1 and 10
                'date' => Carbon::now()->addDays(rand(0, 365)), // Random future date within the next year
                'price' => rand(50, 500) + (rand(0, 99) / 100), // Random price between 50 and 500 with decimals
                'min_stay' => rand(1, 7), // Random min_stay between 1 and 7 days
                'max_stay' => rand(7, 30), // Random max_stay between 7 and 30 days
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
