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
        Schema::create('produk_stok', function (Blueprint $table) {
            $table->bigIncrements('id_stok');
            $table->unsignedBigInteger('id_produk');
            $table->string('size');
            $table->integer('jumlah')->nullable();
            $table->integer('harga_beli')->nullable();
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_stok');
    }
};
