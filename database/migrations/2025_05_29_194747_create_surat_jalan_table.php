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
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->bigIncrements('id_surat_jalan');
            $table->string('kode_faktur')->unique();
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_pengiriman');
            $table->time('jam');
            $table->enum('status', ['gagal', 'diambil', 'pending'])->default('pending');
            $table->timestamps();

            $table->foreign('kode_faktur')->references('kode_faktur')->on('transaksis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalan');
    }
};
