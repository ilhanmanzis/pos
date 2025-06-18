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
        Schema::create('surat_jalan_detail', function (Blueprint $table) {
            $table->bigIncrements('id_surat_jalan_detail');
            $table->unsignedBigInteger('id_surat_jalan');
            $table->string('kode_faktur');
            $table->enum('status', ['gagal', 'diambil', 'pending'])->default('pending');
            $table->timestamps();

            $table->foreign('kode_faktur')->references('kode_faktur')->on('transaksis')->onDelete('cascade');
            $table->foreign('id_surat_jalan')->references('id_surat_jalan')->on('surat_jalan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalan_detail');
    }
};
