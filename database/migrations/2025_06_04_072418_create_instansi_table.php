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
        Schema::create('instansi', function (Blueprint $table) {
            $table->integer('id_instansi')->primary();
            $table->string('nama_instansi');
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
            $table->integer('jumlah_sesi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instansi');
    }

};
