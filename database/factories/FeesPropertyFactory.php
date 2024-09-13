<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyFees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeesProperty>
 */
class FeesPropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$property = Property::factory()->count(1)->create()[0];
        $propertyFees = PropertyFees::factory()->count(1)->create()[0];

        return [
            'property_id' => $this->faker->randomElement([1, 2, 3]),
            'property_fees_id' => $propertyFees->id,
            'amount' => $this->faker->randomFloat(2,1,10),
            'operation' => $this->faker->randomFloat(2,1,10),
            'description' => $this->faker->realText(100)
        ];
    }
}
