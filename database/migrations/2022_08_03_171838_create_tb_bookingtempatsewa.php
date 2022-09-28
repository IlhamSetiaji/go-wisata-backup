<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBookingtempatsewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bookingtempatsewa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket');
            $table->string('kode_booking');
            $table->string('title')->nullable();
            $table->string('nama');
            $table->string('telp');
            $table->string('nik');
            $table->longText('keperluan');
            $table->string('durasi');
            $table->string('biaya')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('user_id')->nullable();
            $table->foreignId('ruang_id')->nullable();
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
        Schema::dropIfExists('tb_bookingtempatsewa');
    }
}
