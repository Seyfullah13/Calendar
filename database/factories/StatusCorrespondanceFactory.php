<?php

namespace Database\Factories;

use App\Models\BookingStatus;
use App\Models\Partenaire;
use App\Models\StatusCorrespondance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusCorrespondance>
 */
class StatusCorrespondanceFactory extends Factory
{
    protected $model = StatusCorrespondance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$bookingStatus = BookingStatus::factory()->count(1)->create()[0];
        // $partenaire = Partenaire::factory()->count(1)->create()[0];

        return [
            'booking_status_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'partenaire_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'status' => $this->faker->randomElement(['En attente', 'En cours de traitement', 'Confirmé', 'Annulée']),
        ];
    }
}
