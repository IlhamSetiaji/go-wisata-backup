<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ruang', function (Blueprint $table) {
            $table->id();
            $table->string('tempatsewa_id');
            $table->string('user_id');
            $table->string('kode_ruang');
            $table->string('nama');
            $table->longText('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->default(1);
            $table->string('harga');
            $table->integer('kapasitas');
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
        Schema::dropIfExists('tb_ruang');
    }
}
