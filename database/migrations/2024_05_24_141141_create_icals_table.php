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
        Schema::create('icals', function (Blueprint $table) {
            $table->id();
            $table->string('ical_url');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('partenaire_id');
            $table->string('calendar_name');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('partenaire_id')->references('id')->on('partenaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icals');
    }
};
