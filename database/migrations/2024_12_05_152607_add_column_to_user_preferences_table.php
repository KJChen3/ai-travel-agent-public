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
        Schema::table('user_preferences', function (Blueprint $table) {
            Schema::table('user_preferences', function (Blueprint $table) {
                $table->string('pref7')->nullable()->after('pref6'); // Replace 'existing_column' with the actual column after which you want to add pref7
                $table->string('pref8')->nullable()->after('pref7');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            //
        });
    }
};
