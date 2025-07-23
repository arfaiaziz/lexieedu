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
        Schema::create('soal', function (Blueprint $table) {
            $table->integer('id_soal')->primary(); // id custom
            $table->integer('id_level'); // foreign key
            $table->text('pertanyaan');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->string('jawaban');
            $table->string('audio')->nullable();
            $table->timestamps();


            $table->foreign('id_level')->references('id_level')->on('level')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal');
    }

};
