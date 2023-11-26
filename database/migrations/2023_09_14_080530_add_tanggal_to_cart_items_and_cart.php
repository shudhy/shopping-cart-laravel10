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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('price');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
};
