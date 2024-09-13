<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // Insérer les statuts de réservation dans la table booking_statuses
         DB::table('booking_statuses')->insert([
            ['name' => 'En attente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'En cours de traitement', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Confirmé', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Annulée', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\BookingStatus::class)->nullable()->constrained();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_statuses');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropforeignIdFor('status_id');
        });
    }
};
