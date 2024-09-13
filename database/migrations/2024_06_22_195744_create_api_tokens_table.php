<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the `api_tokens` table in the database with all the necessary fields
     * to store API token information for different external APIs. Each API can have different
     * authentication types and credentials, which are stored here.
     */
    public function up()
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');  // Name of the API service
            $table->string('base_url');  // Base URL for API requests
            $table->string('auth_type');  // Type of authentication (e.g., 'api_key' or 'oauth')
            $table->string('grant_type')->nullable();
            $table->string('token_url')->nullable();
            $table->string('redirect_uri')->nullable();
            $table->string('authorization_url')->nullable();
            $table->string('webhook_secret')->nullable(); // Secret key for webhook verification
            $table->text('access_token')->nullable();  // Access token for API authentication
            $table->text('refresh_token')->nullable();  // Refresh token for renewing the access token, if applicable
            $table->string('client_id')->nullable();  // Client ID for OAuth
            $table->string('client_secret')->nullable();  // Client secret for OAuth
            $table->timestamp('expires_at')->nullable();  // Expiration time of the access token
            $table->text('api_config')->nullable();  // Additional configuration options for the API
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the `api_tokens` table if it exists, effectively cleaning up the database
     * when the migrations are rolled back.
     */
    public function down()
    {
        Schema::dropIfExists('api_tokens');
    }
}
