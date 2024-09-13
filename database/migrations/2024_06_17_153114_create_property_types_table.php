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
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

         // Insérer les statuts de réservation dans la table booking_statuses
         DB::table('property_types')->insert([
            ['name' => 'House', 'icon' => 'heroicon-o-home-modern', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Appartment', 'icon' => 'heroicon-o-building-office', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bedroom', 'icon' => 'heroicon-o-home', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hotel', 'icon' => 'heroicon-o-building-office-2', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::table('property_attributes', function (Blueprint  $table) {
            $table->unsignedBigInteger('property_type_id')->nullable();

            $table->foreign('property_type_id')->references('id')->on('property_types');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_types');
    }
};
