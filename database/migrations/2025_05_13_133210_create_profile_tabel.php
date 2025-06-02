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
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id_profile');
            $table->string('name');
            $table->string('logo');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->integer('ppn');
            $table->string('nsfp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tabel');
    }
};
