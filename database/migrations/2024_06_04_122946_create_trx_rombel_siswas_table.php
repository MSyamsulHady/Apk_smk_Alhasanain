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
        Schema::create('trx_rombel_siswas', function (Blueprint $table) {
            $table->id('id_trx_rombel_siswa');
            $table->foreignId('id_kelas');
            $table->foreignId('id_siswa');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('trx_rombel_siswas');
    }
};
