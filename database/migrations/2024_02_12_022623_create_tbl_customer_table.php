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
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->id('id_customer');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->foreignId('id_paket')->references('id_paket')->on('tbl_paket');
            $table->string('foto_ktp');
            $table->string('foto_rumah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customer');
    }
};
