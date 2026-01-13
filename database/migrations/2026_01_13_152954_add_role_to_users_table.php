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
    Schema::table('users', function (Blueprint $table) {
        // Pastikan tiga baris ini ada:
        $table->string('role')->default('user')->after('email');
        $table->string('alamat')->nullable();
        $table->string('telepon')->nullable();
    });
}

public function down(): void
    {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
    }
};
