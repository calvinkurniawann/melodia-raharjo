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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order_detail')->references('id')->on('order_details')->onDelete('cascade');
            $table->foreignId('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->string('nama_barang');
            $table->decimal('harga', 10, 2);
            $table->string('shipping_method')->nullable();
            $table->integer('kuantitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};