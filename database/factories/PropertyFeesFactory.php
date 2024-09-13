<?php

namespace Database\Factories;

use App\Models\PropertyFees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProperyFees>
 */
class PropertyFeesFactory extends Factory
{
    protected $model = PropertyFees::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['taxe d\'habitation','taxe foncière','taxe de séjour']),
            'type' => $this->faker->randomElement(['Fees','Taxes']),
            'label' => $this->faker->randomElement(['Habitation','Foncière','Séjour']),
            'guests_included' => $this->faker->randomElement([1,2,3,4]),
        ];
    }
}
