<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false); // 'name' est obligatoire, donc non nullable
            $table->string('display_name')->nullable(); // Utilisation de DB::raw pour définir 'name' comme valeur par défaut
            $table->string('description')->nullable(); // Peut être null
            $table->string('summary')->nullable(); // Peut être null
            $table->integer('square_metre')->nullable(); // Peut être null
            $table->string('time_zone')->nullable(); // Peut être null
            $table->integer('maximum_capacity')->nullable(); // Peut être null
            $table->integer('bedrooms')->nullable(); // Peut être null
            $table->integer('beds')->nullable(); // Peut être null
            $table->integer('bathrooms')->nullable(); // Peut être null
            $table->boolean('pets')->default(false); // Par défaut, 'pets' à false
            $table->boolean('smoking')->default(false); // Par défaut, 'smoking' à false
            $table->boolean('party')->default(false); // Par défaut, 'party' à false
            $table->timestamps();
        });
        
        
        Schema::table('properties', function (Blueprint  $table) {
            $table->foreignIdFor(\App\Models\PropertyAttribute::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_attributes');

        Schema::table('properties', function (Blueprint  $table) {
            $table->dropForeignIdFor(\App\Models\PropertyAttribute::class);
        });
    }
};
