<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array

    {
        $zip_code = strstr($this->faker->postcode, '-', true);

        return [
            'addressable_id' => 1,
            'addressable_type' => 'App\Models\Property',
            'property_number' => $this->faker->numberBetween(1,100),
            'floor' => $this->faker->numberBetween(30,200),
            'building_number' => $this->faker->numberBetween(1,100),
            'street' => $this->faker->streetName,
            'street_number' => $this->faker->numberBetween(1,20),
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip_code' => $zip_code,
            'country_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude
        ];
    }
}
