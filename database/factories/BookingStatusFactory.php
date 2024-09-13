<?php

namespace Database\Factories;

use App\Models\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingStatus>
 */
class BookingStatusFactory extends Factory
{
    protected $model = BookingStatus::class;
    public static $counter = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arr_of_status = ['En attente', 'En cours de traitement', 'Confirmé', 'Annulée'];
        $status = $arr_of_status[$this::$counter % count($arr_of_status)];
        $this::$counter += 1;

        return [
            'name' => $status
        ];
    }
}
