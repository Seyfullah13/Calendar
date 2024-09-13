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
        Schema::create('my_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('rank');
            $table->timestamps();
        });

        // Insert default data
        DB::table('my_roles')->insert([
            ['name' => 'Super Admin', 'rank' => 1],
            ['name' => 'Admin', 'rank' => 2],
            ['name' => 'Owner', 'rank' => 3],
            ['name' => 'Co-owner', 'rank' => 4],
            ['name' => 'Manager', 'rank' => 5],
            ['name' => 'Collaborator', 'rank' => 6],
            ['name' => 'Maid', 'rank' => 7],
            ['name' => 'Technician', 'rank' => 8],
            ['name' => 'Service Manager', 'rank' => 9],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_roles');
    }
};
