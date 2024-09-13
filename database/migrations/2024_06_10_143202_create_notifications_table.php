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
        Schema::create('my_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');
            $table->text('data');
            $table->timestamps();

            // $table->foreignIdFor(\App\Models\Conversation::class)->constrained('conversations');
            $table->foreign('conversation_id')->references('id')->on('conversations');
            
            // $table->foreignIdFor(\App\Models\User::class)->constrained('users');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_notifications');
    }
};
