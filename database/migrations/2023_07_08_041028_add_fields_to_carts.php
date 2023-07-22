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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('alamat_tujuan')->nullable();
            $table->string('desa')->nullable();
            $table->string('no_tlpn')->nullable();
            $table->decimal('ongkos_kirim', 8, 2)->nullable();
            $table->string('metode_pembayaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['alamat_tujuan', 'desa', 'no_tlpn', 'ongkos_kirim', 'metode_pembayaran']);
        });
    }
};
