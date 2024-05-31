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
        Schema::create('absens', function (Blueprint $table) {
            $table->id('id_absen');
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_kelasPelajaran');
            $table->foreign('id_kelasPelajaran')->references('id_kelasPelajaran')->on('kelas_pelajarans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
};
