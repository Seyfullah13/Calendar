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

        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('equipment_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Equipment::class,'parent_id')->nullable()->constrained('equipments');
            $table->foreignIdFor(\App\Models\Equipment::class,'child_id')->nullable()->constrained('equipments');
        });

        Schema::create('equipment_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->nullable();
            $table->string('description');
            $table->boolean('is_room');
            $table->boolean('is_furniture');
            $table->boolean('is_accesory');
        });

        Schema::create('equipment_availabilities', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_start');
            $table->datetime('date_end');
        });

        Schema::create('property_equipments', function (Blueprint $table) {
            $table->id();
            $table->boolean('private');
            $table->integer('number');
            $table->integer('order');
            $table->foreignId('description_id')->constrained('equipment_descriptions');
            $table->foreignId('availability_id')->nullable()->constrained('equipment_availabilities');
            $table->foreignId('equipment_id')->constrained('equipments');
            $table->foreignId('parent_id')->nullable()->constrained('property_equipments');
        });

        Schema::create('property_property_equipment', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\PropertyEquipment::class)->constrained('property_equipments');
            $table->foreignIdFor(\App\Models\Property::class)->constrained('properties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_dependencies');
        Schema::dropIfExists('equipment_descriptions');
        Schema::dropIfExists('equipment_availabilities');
        Schema::dropIfExists('property_equipments');
        Schema::dropIfExists('property_property_equipment');
        Schema::dropIfExists('property_equipment_photos');
    }
};
