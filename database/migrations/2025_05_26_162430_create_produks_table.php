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
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('kode')->unique();
            $table->string('name');
            $table->string('merk');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->enum('satuan', ['box', 'roll', 'pack']);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
