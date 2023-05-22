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
        Schema::create('product_supplier_invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_invoice_id');
            $table->foreign('supplier_invoice_id')->references('id')->on('supplier_invoices')->onDelete('cascade');
            $table->decimal('qty',12,2)->default(1);
            $table->unsignedBigInteger('product_price')->default(0);
            $table->decimal('total',8,2)->default(0);
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
        Schema::dropIfExists('product_supplier_invoice');
    }
};
