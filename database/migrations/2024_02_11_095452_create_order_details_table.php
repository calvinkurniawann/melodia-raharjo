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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('unique_string', 10)->unique();
            $table->timestamps();
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->double('total_harga');
            $table->enum('status', ['Menunggu Konfirmasi', 'Proses', 'Dikirim', 'Selesai']);
            $table->enum('payment_status', ['pending', 'paid', 'canceled']);
            $table->string('snap_token')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};