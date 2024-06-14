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
            $table->foreignId('id_pertemuan');
            $table->foreign('id_pertemuan')->references('id_pertemuan')->on('pertemuans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_trx_rombel_siswa');
            $table->foreign('id_trx_rombel_siswa')->references('id_trx_rombel_siswa')->on('trx_rombel_siswas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('keterangan', ['hadir', 'alpa', 'bolos', 'sakit', 'izin']);
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
        Schema::dropIfExists('absens');
    }
};
