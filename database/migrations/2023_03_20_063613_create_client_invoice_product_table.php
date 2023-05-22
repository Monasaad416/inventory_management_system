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
        Schema::create('client_invoice_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('client_invoice_id');
            $table->foreign('client_invoice_id')->references('id')->on('client_invoices')->onDelete('cascade');
            $table->decimal('qty',12,2)->default(1);
            $table->unsignedBigInteger('product_price')->default(0);
            $table->decimal('total',12,2)->default(0);
            $table->enum('status',['unpaid','paid','partially_paid','returned','partially_returned'])->default('unpaid');
            $table->enum('unit',['متر','كجم',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_invoice_product');
    }
};
