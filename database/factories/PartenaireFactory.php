<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partenaire>
 */
class PartenaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'url_commercial' => $this->faker->url,
            'url_api' => $this->faker->url,
            'icon' => $this->faker->imageUrl,
            'description' => $this->faker->text('50'),
            'border_color' => $this->faker->text('50'),
            'background_color' => $this->faker->text('50'),
        ];
    }
}
