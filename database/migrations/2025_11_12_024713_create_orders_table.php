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
        $table->id(); // Sesuai id (PK)
        $table->unsignedBigInteger('user_id'); // Sesuai user_id (FK)
        $table->date('tanggal'); // Sesuai tanggal
        $table->decimal('total', 12, 2); // Sesuai total
        $table->string('bukti_pembayaran')->nullable(); // Sesuai bukti_pembayaran
        $table->enum('status_pembayaran', ['pending', 'lunas', 'gagal', 'diproses']) // Sesuai status_pembayaran
              ->default('pending'); 
        $table->timestamps(); // Sesuai created_at & updated_at

        // Relasi ke tabel users
        $table->foreign('user_id')->references('id')->on('users');
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
