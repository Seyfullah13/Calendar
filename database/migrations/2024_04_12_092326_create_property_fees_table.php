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
        Schema::create('property_fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('label');
            $table->integer('guests_included');
            $table->timestamps();
        });

        Schema::create('fees_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Property::class)->constrained('properties');
            $table->foreignIdFor(\App\Models\PropertyFee::class)->constrained('property_fees');
            $table->integer('amount');
            $table->integer('operation');
            $table->string('description');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_fees');
        Schema::dropIfExists('fees_properties');
    }
};
