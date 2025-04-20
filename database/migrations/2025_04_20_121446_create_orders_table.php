<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('offer_price');
            $table->string('counter_price')->nullable();

            $table->string('quantity');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected', 'Countered','Cancelled'])->default('Pending');
            $table->foreignId('product_id')->constrained('products_details')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('user_details')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('user_details')->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_status')->default('Pending');
            $table->enum('cancelledby', ['Buyer', 'Seller'])->nullable();
            $table->string('cancel_reason')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
