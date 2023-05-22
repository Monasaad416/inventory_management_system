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
        Schema::create('client_invoices', function (Blueprint $table) {
              $table->id();
            $table->string('client_invoice_number', 50);
            $table->date('client_invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->decimal('collection_amount',8,2)->nullable();;
            // $table->decimal('commission_amount',8,2);
            $table->decimal('discount',12,2)->nullable();
            // $table->decimal('value_vat',8,2);
            // $table->string('rate_vat', 999);
            $table->decimal('total',12,2)->default(0);
            $table->decimal('part_paid',12,2)->default(0);
            // $table->string('status', 50);
            $table->integer('status');
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_invoices');
    }
};
