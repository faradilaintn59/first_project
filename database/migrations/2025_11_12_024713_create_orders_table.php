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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary(); 
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal'); 
            $table->decimal('total', 12, 2); 
            
            // Tambahan kolom untuk pengiriman & pembayaran 
            $table->string('alamat'); 
            $table->string('telepon');
            $table->string('metode'); 

            $table->string('bukti_pembayaran')->nullable(); 
            $table->enum('status_pembayaran', ['pending', 'lunas', 'gagal', 'diproses'])
                  ->default('pending'); 
            $table->timestamps();

            // Relasi ke tabel users 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};