<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->unsignedBigInteger('pengelola_gudang_id');
            $table->foreign('pengelola_gudang_id')->references('pengelola_gudang_id')->on('pengelola_gudang');
            $table->string('judul_laporan');
            $table->date('tanggal_laporan');
            $table->string('deskripsi')->nullable();
            $table->enum('status_laporan', ['pending', 'approved', 'rejected']);
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('inventory_id')->on('inventory');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
