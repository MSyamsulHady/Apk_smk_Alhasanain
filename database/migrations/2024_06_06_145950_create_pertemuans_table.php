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
            $table->foreignId('id_rombel');
            $table->foreign('id_rombel')->references('id_rombel')->on('rombels')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pertemuanKe', '25')->nullable()->default('text');
            $table->date('tanggal_pertemuan')->nullable();
            $table->time('mulai')->nullable();
            $table->time('selesai')->nullable();
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
