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
        Schema::create('journey_details', function (Blueprint $table) {
            $table->foreignId('journey_id') // Reference to the journey table
                  ->constrained('journeys') // Points to the journeys table
                  ->onDelete('cascade');    // Deletes journey details when a journey is deleted
            $table->date('date');
            $table->integer('sequence');
            $table->string('type');
            $table->string('name');
            $table->text('introduction')->nullable();
            $table->time('time')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journey_details');
    }
};
