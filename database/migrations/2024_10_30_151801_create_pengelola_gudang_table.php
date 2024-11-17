<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaGudangTable extends Migration
{
    public function up()
    {
        Schema::create('pengelola_gudang', function (Blueprint $table) {
            $table->id('pengelola_gudang_id')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengelola_gudang');
    }
}

