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
        Schema::create('shareholder_accounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount')->default(0);
            $table->text('notes')->nullable();
            $table->enum('type',['capital','profit']);
            $table->unsignedBigInteger('shareholder_id')->unsigned()->nullable();
            $table->foreign('shareholder_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shareholder_accounts');
    }
};
