<?php

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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->foreignIdFor(App\Models\User::class, 'user_id')->nullable()->constrained('users');
            $table->string('first_name'); 
            $table->string('full_name'); 
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('local')->nullable();
            $table->string('picture_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->string('location')->nullable();
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
