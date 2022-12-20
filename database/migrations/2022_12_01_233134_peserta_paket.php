<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PesertaPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_paket', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peserta')->nullable();
            $table->string('kode_booking');
            $table->string('name');
            $table->string('email');
            $table->string('telp');
            $table->integer('status')->default(1);
            $table->foreignId('paket_id')->nullable();
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
        Schema::dropIfExists('peserta_paket');
    }
}
