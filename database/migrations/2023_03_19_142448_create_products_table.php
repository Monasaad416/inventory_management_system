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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',999);
            $table->string('product_code',999);
            $table->text('description')->nullable();
            $table->decimal('purchase_price',8,2);
            $table->decimal('sale_price',12,2);
            $table->unsignedBigInteger('section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id' )->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('store_amount',12,2);
            $table->enum('unit',['متر','كجم',])->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
