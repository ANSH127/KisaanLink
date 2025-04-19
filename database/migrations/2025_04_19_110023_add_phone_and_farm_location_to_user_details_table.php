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
        Schema::table('user_details', function (Blueprint $table) {
            //
            $table->string('phone')->nullable(); // Add phone field
            $table->string('farm_location')->nullable(); // Add farm location field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            //
            $table->dropColumn('phone'); // Remove phone field
            $table->dropColumn('farm_location'); // Remove farm location field
        });
    }
};
