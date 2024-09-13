<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Address;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Partenaire;
use App\Models\BookingGuest;
use App\Models\Conversation;
use App\Models\StatusCorrespondance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
  protected $model = Booking::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $property = Property::factory()->create();
    $property_address = Address::factory()->create(['addressable_id' => $property->id]);
    $property->address()->save($property_address);
    $property->refresh();

    $photo = Photo::create([
      'url' => 'property_images/01J4S7DZ1R0FP0G5AK36NDKHP4.jpg'
    ]);
    $property->photos()->attach($photo->id);

    $guest = BookingGuest::inRandomOrder()->first();
    $status = StatusCorrespondance::factory()->create();

    $checkIn = $this->faker->dateTimeBetween('now', '+1 week');
    $checkOut = $this->faker->dateTimeBetween($checkIn->format('Y-m-d H:i:s') . ' +1 day', $checkIn->format('Y-m-d H:i:s') . ' +3 week');

    $bookedAt = $this->faker->dateTimeBetween('2024-01-01', $checkIn->format('Y-m-d H:i:s'));

    $interval = $checkIn->diff($checkOut);
    $numberOfNights = $interval->days;

    return [
      // 'currency_id' => $this->faker->randomElement([1, 2, 3, 4]),
      'preparation_time' => $this->faker->randomElement(['00:15', '00:30', '00:45']),
      'check_in' => $checkIn,
      'check_out' => $checkOut,
      'number_of_nights' => $numberOfNights,
      'number_of_guests' => $this->faker->randomElement([1, 2, 3, 4]),
      'number_of_adults' => $this->faker->randomElement([1, 2, 3, 4]),
      'number_of_children' => $this->faker->randomElement([1, 2]),
      'number_of_animals' => $this->faker->randomElement([1, 2]),
      'external_reservation_id' => $this->faker->regexify('\d{10}'),
      'uid' => $this->faker->regexify('[A-Za-z0-9!@#$%^&*()]{16}'),
      'external_status' => $this->faker->randomElement(['En attente', 'En cours de traitement', 'Confirmé', 'Annulée']),
      'total_fees' => $this->faker->randomFloat(2, 0, 10),
      'total_taxes' => $this->faker->randomFloat(2, 0, 10),
      'total_payout' => $this->faker->randomFloat(2, 20, 100),
      // 'booked_at' => $this->faker->dateTimeBetween('2024-01-01', 'now')->format('Y-m-d H:i:s'),
      'booked_at' => $bookedAt,
      'token' => 'token_' . $this->faker->regexify('\d{10}'),
      'booking_guest_id' => $guest->id,
      'property_id' => $property->id,
      'partenaire_id' => $status->partenaire_id,
      'booking_status_id' => $status->booking_status_id,
    ];
  }
}