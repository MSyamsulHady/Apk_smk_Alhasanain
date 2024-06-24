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
            $table->foreignId('id_trx_rombel_siswa');
            $table->foreignId('id_semester');
            $table->integer('tugas1');
            $table->integer('tugas2');
            $table->integer('tugas3');
            $table->integer('tugas4');
            $table->integer('tugas5');
            $table->integer('tugas6');
            $table->integer('uts');
            $table->integer('uas');
            $table->foreign('id_trx_rombel_siswa')->references('id_trx_rombel_siswa')->on('trx_rombel_siswas')->cascadeOnDelete()->cascadeOnUpdate();
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
