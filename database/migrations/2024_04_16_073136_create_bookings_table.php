<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\CurrencyEnum;

class CreateBookingsTable extends Migration
{
    public function up() : void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Property::class)->constrained('properties');
            $table->time('preparation_time')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('number_of_nights');
            $table->integer('number_of_guests')->nullable();
            $table->integer('number_of_adults')->nullable();
            $table->integer('number_of_children')->nullable();
            $table->integer('number_of_animals')->nullable();
            $table->string('external_reservation_id')->nullable();
            $table->string('uid')->nullable();
            $table->string('external_status')->nullable();
            $table->float('total_fees')->nullable();
            $table->float('total_taxes')->nullable();
            $table->float('total_payout')->nullable();
            $table->dateTime('booked_at');
            $table->string('token')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('bookings');
    }
}
