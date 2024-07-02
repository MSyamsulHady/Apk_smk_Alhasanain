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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nisn');
            $table->string('nis');
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->string('orang_tua');
            $table->string('nohp_ortu', 15)->nullable();
            $table->enum('jurusan', ['RPL', 'Perhotelan']);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('siswas');
    }
};
