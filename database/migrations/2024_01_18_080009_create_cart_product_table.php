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
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_product')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreignId('id_cart')->references('id')->on('carts')->onDelete('cascade');
            $table->integer('kuantitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};