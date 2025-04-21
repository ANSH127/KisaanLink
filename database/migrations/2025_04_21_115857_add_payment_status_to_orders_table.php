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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed'])->default('Pending');
            $table->string('razorpay_payment_id')->nullable(); // Add Razorpay payment ID field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('payment_status'); // Remove payment status field
            $table->dropColumn('razorpay_payment_id'); // Remove Razorpay payment ID field
        });
    }
};
