<?php

namespace Database\Seeders;

use App\Models\PropertyAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PropertyAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyAttribute::factory()->count(5)->create();

        // DB::table('property_attributes')->insert([
        //     [
        //         'nickname' => 'Appartement à Gueliz',
        //         'name' => 'Gueliz',
        //         'description' => 'Appartement plein centre ville',
        //         'square_metre' => 100,
        //         'time_zone' => 'UCT+2',
        //         'type' => 'Appartement',
        //         'maximum_capacity' => 4,
        //         'bedrooms' => 2,
        //         'beds' => 3,
        //         'bathroom' => 1,
                
        //     ],
        //     [
        //         'nickname' => 'Appartement à Ain Itti',
        //         'name' => 'Ain Itti',
        //         'description' => 'Appartement moderne calme et proche centre ville',
        //         'square_metre' => 120,
        //         'time_zone' => 'UCT+2',
        //         'type' => 'Appartement',
        //         'maximum_capacity' => 6,
        //         'bedrooms' => 3,
        //         'beds' => 4,
        //         'bathroom' => 2,
                
        //     ],
        //     [
        //         'nickname' => 'Appartement à Neuilly Plaisance',
        //         'name' => 'Neuilly Plaisance',
        //         'description' => 'Superbe appartement situé à Neuilly Plaisance',
        //         'square_metre' => 80,
        //         'time_zone' => 'UCT+2',
        //         'type' => 'Appartement',
        //         'maximum_capacity' => 2,
        //         'bedrooms' => 1,
        //         'beds' => 1,
        //         'bathroom' => 1,
                
        //     ],
        // ]);
    }
}
