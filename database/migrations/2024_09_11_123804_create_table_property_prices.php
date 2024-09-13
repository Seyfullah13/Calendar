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
        Schema::create('property_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained(); // Assuming 'property_id' references another table
            $table->date('date'); // Field for the date
            $table->double('price', 8, 2); // Double field with precision
            $table->integer('min_stay'); // Minimum stay as an integer
            $table->integer('max_stay'); // Maximum stay as an integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_prices');
    }
};
