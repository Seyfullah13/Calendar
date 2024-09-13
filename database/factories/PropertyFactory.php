<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Address;
use App\Models\PropertyAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $attribute = PropertyAttribute::factory()->count(1)->create()[0];

        return [
            'property_attribute_id' => $attribute->id,
        ];
    }
}
