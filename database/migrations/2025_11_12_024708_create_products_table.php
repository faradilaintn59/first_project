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
        Schema::create('products', function (Blueprint $table) {
        $table->id(); // Sesuai id (PK)
        $table->unsignedBigInteger('kategori_id'); // Sesuai kategori_id (FK)
        $table->string('nama'); // Sesuai nama
        $table->text('deskripsi'); // Sesuai deskripsi
        $table->decimal('harga', 8, 2); // Sesuai harga
        $table->integer('stok')->default(0); // Sesuai stok
        $table->string('foto'); // Sesuai foto
        $table->timestamps(); // Sesuai created_at & updated_at

        // Relasi ke tabel categories
        $table->foreign('kategori_id')->references('id')->on('categories');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
