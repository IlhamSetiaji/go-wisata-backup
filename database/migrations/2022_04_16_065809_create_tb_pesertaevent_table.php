<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPesertaeventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pesertaevent', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peserta')->nullable();
            $table->string('kode_booking');
            $table->string('nama_peserta');
            $table->string('email');
            $table->string('telp');
            $table->integer('status')->default(1);
            $table->foreignId('event_id')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('tb_pesertaevent');
    }
}
