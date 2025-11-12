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
        Schema::create('order_products', function (Blueprint $table) {
        $table->id(); // Sesuai id (PK)
        $table->unsignedBigInteger('order_id'); // Sesuai order_id (FK)
        $table->unsignedBigInteger('product_id'); // Sesuai product_id (FK)
        $table->integer('jumlah'); // Sesuai jumlah
        $table->decimal('harga_satuan', 10, 2); // Sesuai harga_satuan
        $table->timestamps(); // Sesuai created_at & updated_at

        // Relasi ke tabel orders
        $table->foreign('order_id')->references('id')->on('orders');
        // Relasi ke tabel products
        $table->foreign('product_id')->references('id')->on('products');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
