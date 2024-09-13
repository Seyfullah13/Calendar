<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\BookingGuest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingGuest::factory()->count(10)->create();

        $guests = BookingGuest::all();

        foreach ($guests as $guest) {
            $address = Address::factory()->create([
                'addressable_id' => $guest->id,
                'addressable_type' => 'App\Models\BookingGuest'
            ]);

            $guest->address()->save($address);
        }

    }
}
