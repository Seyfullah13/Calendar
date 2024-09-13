<?php

namespace Database\Factories;

use App\Models\PropertyAttribute;
use Faker\Core\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttribute>
 */
class PropertyAttributeFactory extends Factory
{
    protected $model = PropertyAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time1 = new \DateTime();
        $time1->setTime(0, 15);

        $time2 = new \DateTime();
        $time2->setTime(0, 30);

        $time3 = new \DateTime();
        $time3->setTime(0, 45);

        $time4 = new \DateTime();
        $time4->setTime(1, 0);

        $tab =  array($time1,$time2,$time3,$time4);

        return [
            'display_name' => $this->faker->lastName,
            'name' => $this->faker->sentences(1)[0],
            'description' => $this->faker->realText(100),
            'square_metre' => $this->faker->numberBetween(30, 200),
            'time_zone' => $this->faker->timezone,
            'property_type_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'maximum_capacity' => $this->faker->numberBetween(1, 5),
            'bedrooms' => $this->faker->numberBetween(1, 2),
            'beds' => $this->faker->numberBetween(1, 2),
            'bathrooms' => $this->faker->numberBetween(1, 2),
        ];
    }
}
