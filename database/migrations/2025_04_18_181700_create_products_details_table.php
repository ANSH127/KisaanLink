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
        Schema::create('products_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); 
            $table->string('produce_type'); 
            $table->integer('quantity'); 
            $table->decimal('price', 10, 2);
            $table->string('quality_grade'); 
            $table->date('available_dates_from'); 
            $table->date('available_dates_to'); 
            $table->string('image_url')->nullable(); 
            $table->text('additional_notes')->nullable(); 
            $table->unsignedBigInteger('seller_id'); // Foreign key for the seller (user_details table)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('seller_id')->references('id')->on('user_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_details');
    }
};
