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
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // Insérer les statuts de réservation dans la table booking_statuses
         DB::table('timezones')->insert([
            ['name' => 'Europe/Paris', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'America/New_York', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia/Tokyo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Australia/Sydney', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'UTC (Coordinated Universal Time)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Africa/Cairo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia/Dubai', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pacific/Honolulu', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'America/Los_Angeles', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Europe/London', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timezones');
    }
};
