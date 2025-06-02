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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->string('kode_pelanggan');
            $table->string('kode_faktur')->unique();
            $table->date('tanggal');
            $table->enum('jenis', ['biasa', 'sample']);
            $table->enum('status', ['lunas', 'belum bayar']);
            $table->bigInteger('total_harga');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('kode_pelanggan')->references('kode_pelanggan')->on('pelanggans');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
