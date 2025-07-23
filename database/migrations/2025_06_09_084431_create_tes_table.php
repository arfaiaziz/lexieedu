<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tes', function (Blueprint $table) {
            $table->integer('id_tes')->primary();
            $table->date('tgl_tes');
            $table->integer('id_peserta');
            $table->integer('id_soal');
            $table->string('nama_soal');
            $table->string('jawaban_soal');
            $table->string('jawaban_peserta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
