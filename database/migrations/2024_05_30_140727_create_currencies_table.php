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

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol');
            $table->boolean('symbol_first');
            $table->boolean('symbol_espace');
            $table->string('decimal_mark');
            $table->string('thousand_separator');
            $table->string('icon');
        });

        // Chemin vers le fichier JSON
        $jsonPath = app_path('currencies.json');

        $jsonContent = file_get_contents($jsonPath);
        $currencies = json_decode($jsonContent, true);

        if (is_array($currencies)) {
            $dataToInsert = [];
            
            foreach ($currencies as $code => $details) {
                $dataToInsert[] = [
                    'name' => $details['name'],
                    'code' => $code,
                    'symbol' => $details['symbol'],
                    'symbol_first' => $details['symbol_first'],
                    'symbol_espace' => $details['symbol_espace'],
                    'decimal_mark' => $details['decimal_mark'] ?? '.', // Valeur par défaut si non spécifiée
                    'thousand_separator' => $details['thousand_separator'] ?? ',', // Valeur par défaut si non spécifiée
                    'icon' => $details['icon'] ?? 'default.png', // Valeur par défaut si non spécifiée
                ];
            }

            // Insertion des données dans la table
            DB::table('currencies')->insert($dataToInsert);
        }

        Schema::create('exchange_currencies', function (Blueprint $table) {
            $table->id();
            $table->decimal('exchange_rate', 15, 8); // Utiliser decimal pour plus de précision            
            $table->foreignIdFor(\App\Models\Currency::class)->constrained('currencies');
            $table->date('day_of_exchange');
            $table->foreignId('exchange_to')->constrained('currencies'); // Référence à la table currencies
        });

        Schema::table('property_attributes', function (Blueprint  $table) {
            $table->unsignedBigInteger('currency_id')->default(46);

            $table->foreign('currency_id')->references('id')->on('currencies');
        });

        // Schema::table('bookings', function (Blueprint  $table) {
        //     $table->foreignIdFor(\App\Models\Currency::class)->constrained();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
