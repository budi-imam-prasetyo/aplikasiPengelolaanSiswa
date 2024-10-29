<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->enum('gender', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon', 15);
            $table->date('tanggal_masuk');
            $table->enum('status', ['Aktif', 'Keluar', 'Mutasi']);
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
