<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id') // Foreign key referencing users table
                  ->constrained('users')
                  ->onDelete('cascade'); // Delete preferences if user is deleted
            $table->string('pref1')->nullable(); // Preference columns
            $table->string('pref2')->nullable();
            $table->string('pref3')->nullable();
            $table->string('pref4')->nullable();
            $table->string('pref5')->nullable();
            $table->string('pref6')->nullable();
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
