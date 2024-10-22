<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key
            $table->string('ip'); // Store the IP address
            $table->string('city')->nullable(); // Store the city
            $table->string('region')->nullable(); // Store the region
            $table->string('country')->nullable(); // Store the country
            $table->string('postal')->nullable(); // Store the postal code
            $table->string('timezone')->nullable(); // Store the timezone
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories'); // Drop the table if it exists
    }
}
