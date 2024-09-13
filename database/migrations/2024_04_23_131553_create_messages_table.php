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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reply_to_id')->nullable();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('contact_id');
            $table->tinyInteger('order');
            $table->enum('message_type',['message','notification'])->default('message');
            $table->text('message_text');
            $table->timestamp('sent_at');
            $table->timestamps();
            $table->softDeletes();

        
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('reply_to_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
