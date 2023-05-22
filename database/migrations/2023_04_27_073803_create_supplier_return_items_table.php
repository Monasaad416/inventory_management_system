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
        Schema::create('supplier_return_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_invoice_id');
            $table->foreign('supplier_invoice_id')->references('id')->on('supplier_invoices')->onDelete('cascade');
             $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('price',12,2);
            $table->decimal('qty',12,2)->default(1);
            $table->decimal('total',12,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_return_items');
    }
};
