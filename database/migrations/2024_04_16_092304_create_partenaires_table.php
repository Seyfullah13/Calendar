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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url_commercial');
            $table->string('url_api');
            $table->string('icon');
            $table->string('description');
            $table->string('border_color');
            $table->string('background_color');
            $table->timestamps();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Partenaire::class)->nullable()->constrained();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropforeignIdFor('partenaire_id');
        });
    }
};
