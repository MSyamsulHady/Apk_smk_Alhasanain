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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id('id_pertemuan');
            $table->foreignId('id_absen');
            $table->foreign('id_absen')->references('id_absen')->on('absens')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pertemuan', 10)->nullable();
            $table->date('tanggal_pertemuan');
            $table->time('mulai');
            $table->time('akhir');
            $table->enum('keterangan', ['alpa', 'hadir', 'bolos', 'izin', 'sakit'])->nullable();
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
        Schema::dropIfExists('pertemuans');
    }
};
