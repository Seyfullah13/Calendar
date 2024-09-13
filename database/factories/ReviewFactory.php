<?php

namespace Database\Factories;

use App\Models\BookingGuest;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

            'type' => $this->faker->randomElement(['accommodation', 'cleaning']),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'booking_guest_id' => BookingGuest::factory(),
            'property_id' => Property::factory(),
        ];
    }
}
