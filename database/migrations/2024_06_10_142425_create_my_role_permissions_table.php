<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\MyRole;
use App\Models\MyFeature;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('my_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\MyRole::class)->constrained('my_roles');      
            $table->foreignIdFor(\App\Models\MyFeature::class)->constrained('my_features');
            $table->boolean('read');
            $table->boolean('write');
            $table->boolean('edit');
            $table->boolean('share');
            $table->boolean('delete');
            $table->boolean('privacy');
            $table->boolean('price');
            $table->timestamps();
        });


        // Insert default permissions for each role and feature combination
        $roles = MyRole::all();
        $features = MyFeature::all();

        foreach ($roles as $role) {
            foreach ($features as $feature) {
                DB::table('my_role_permissions')->insert([
                    'my_role_id' => $role->id,
                    'my_feature_id' => $feature->id,
                    'read' => true,
                    'write' => false,
                    'edit' => false,
                    'share' => false,
                    'delete' => false,
                    'privacy' => false,
                    'price' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_role_permissions');
    }
};
