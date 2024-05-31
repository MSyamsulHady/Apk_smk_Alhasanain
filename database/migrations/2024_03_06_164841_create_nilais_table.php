<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_siswa');
            $table->foreignId('id_kelasPelajaran');
            $table->foreignId('id_semester');
            $table->integer('tugas');
            $table->integer('uts');
            $table->integer('uas');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kelasPelajaran')->references('id_kelasPelajaran')->on('kelas_pelajarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
};
