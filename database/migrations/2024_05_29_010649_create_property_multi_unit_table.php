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
        Schema::create('property_multi_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id'); 
            $table->string('name');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_multi_unit');
    }
};
