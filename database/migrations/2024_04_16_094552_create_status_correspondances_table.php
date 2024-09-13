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
        Schema::create('status_correspondances', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->foreignIdFor(\App\Models\BookingStatus::class)->constrained('booking_statuses');
            $table->foreignIdFor(\App\Models\Partenaire::class)->constrained('partenaires');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_correspondances');
    }
};
