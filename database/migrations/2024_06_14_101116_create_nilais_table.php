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
            $table->foreignId('id_rombel');
            $table->foreignId('id_siswa');
            $table->integer('nilai')->nullable();
            $table->integer('rata-rata')->nullable();
            $table->foreign('id_rombel')->references('id_rombel')->on('rombels')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('nilais');
    }
};
