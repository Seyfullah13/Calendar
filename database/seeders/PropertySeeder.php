<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Address;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::factory()->count(3)->create();

        $properties = Property::all();

        foreach ($properties as $property) {
            $address = Address::factory()->create([
                'addressable_id' => $property->id,
            ]);

            $photo = Photo::factory()->create();
            
            $property->address()->save($address);
            $property->photos()->attach($photo->id);
        }

        // $propertyAttributeIds = [1, 2, 3];
        // $propertyAddressIds = [1, 2, 3, 4];

        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('properties')->insert([
        //         'property_attribute_id' => $propertyAttributeIds[array_rand($propertyAttributeIds)],
        //         'property_address_id' => $propertyAddressIds[array_rand($propertyAddressIds)],
        //     ]);
        // }
    }
}
