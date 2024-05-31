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
        Schema::create('detail_kelas', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_siswa');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('detail_kelas');
    }
};
