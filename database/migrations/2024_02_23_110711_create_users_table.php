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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_semester')->nullable();
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('username');
            $table->enum('role', ['admin', 'siswa', 'guru', 'kepsek', 'wakasek'])->default('siswa');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
