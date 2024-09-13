<?php

namespace Database\Factories;

use App\Models\BookingGuest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingGuest>
 */
class BookingGuestFactory extends Factory
{
  protected $model = BookingGuest::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'first_name' => $this->faker->firstName,
      'last_name' => $this->faker->lastName,
      'email' => $this->faker->email,
      'phone' => $this->faker->phoneNumber,
      'picture' => $this->faker->imageUrl,
    ];
  }
}