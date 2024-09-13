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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

         // Chemin vers le fichier JSON
         $jsonPath = app_path('countries.json');

         // Lire le fichier JSON
         $countries = json_decode(file_get_contents($jsonPath), true);
 
         // Insertion des données dans la table
         DB::table('countries')->insert($countries);

         Schema::table('addresses', function (Blueprint  $table) {
            $table->unsignedBigInteger('country_id');

            $table->foreign('country_id')->references('id')->on('countries');
        });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
