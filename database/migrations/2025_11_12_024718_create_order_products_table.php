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
            $table->id();
            $table->integer("jumlah"); 
            $table->decimal("harga_satuan", 10, 2); 
            
            // PENTING: Ubah menjadi string agar sama dengan ID di tabel orders 
            $table->string('order_id'); 
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); 
            
            // Relasi ke tabel products 
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            $table->timestamps();
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