<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hotel', function (Blueprint $table) {
            $table->id();
            $table->string('tempat_id');
            $table->string('user_id');
            $table->string('kode_hotel');
            $table->string('nama');
            $table->longText('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('telp')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('tb_hotel');
    }
}
