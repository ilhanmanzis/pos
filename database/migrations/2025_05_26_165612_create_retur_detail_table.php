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
        Schema::create('retur_detail', function (Blueprint $table) {
            $table->bigIncrements('id_detail');
            $table->unsignedBigInteger('id_retur');
            $table->unsignedBigInteger('id_stok');
            $table->unsignedBigInteger('id_produk');
            $table->string('satuan');
            $table->integer('jumlah_satuan')->nullable();
            $table->timestamps();
            $table->foreign('id_retur')->references('id_retur')->on('returs')->onDelete('cascade');
            $table->foreign('id_stok')->references('id_stok')->on('produk_stok');
            $table->foreign('id_produk')->references('id_produk')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_detail');
    }
};
