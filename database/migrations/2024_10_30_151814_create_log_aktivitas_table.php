<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAktivitasTable extends Migration
{
    public function up()
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id')->references('pengelola_gudang_id')->on('pengelola_gudang');
            $table->string('aksi');
            $table->date('tanggal_aksi');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_aktivitas');
    }
}

