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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->after('name')->nullable();
            $table->unsignedBigInteger('id_kategori')->after('image');
            $table->foreign('id_kategori')->references('id')->on('kategori_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('image');
            $table->dropColumn('id_kategori');
        });
    }
};
