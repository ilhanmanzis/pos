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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->bigIncrements('id_pengeluaran');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kategori_pengeluaran');
            $table->text('keterangan');
            $table->bigInteger('harga');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_kategori_pengeluaran')->references('id_kategori_pengeluaran')->on('kategori_pengeluaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
