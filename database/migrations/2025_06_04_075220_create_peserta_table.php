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
        Schema::create('peserta', function (Blueprint $table) {
            $table->integer('id_peserta')->primary();
            $table->string('nama_peserta');
            $table->integer('umur');
            $table->text('alamat');
            $table->string('email');
            $table->date('tgl_daftar');
            $table->integer('id_level');
            $table->integer('id_instansi');
            $table->timestamps();

            $table->foreign('id_level')->references('id_level')->on('level')->onDelete('cascade');
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peserta');
    }
};
