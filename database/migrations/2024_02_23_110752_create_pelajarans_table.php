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
        Schema::create('pelajarans', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->foreignId('id_guru');
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_mapel', 100)->nullable()->default('text');
            $table->enum('kurikulum', ['K-13', 'Merdeka']);
            $table->string('muatan');
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
        Schema::dropIfExists('pelajarans');
    }
};
