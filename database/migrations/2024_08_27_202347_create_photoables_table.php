<?php

use App\Models\Photo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photoables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Photo::class)->constrained('photos')->cascadeOnDelete();
            $table->morphs('photoable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photoables');
    }
};
