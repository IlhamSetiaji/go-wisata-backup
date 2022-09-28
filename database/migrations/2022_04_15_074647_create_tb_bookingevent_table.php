<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBookingeventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bookingevent', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket');
            $table->string('kode_booking');
            $table->string('nama');
            $table->string('jml_orang');
            $table->string('biaya')->nullable();
            $table->integer('status')->default(0);
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('event_id')->nullable();
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
        Schema::dropIfExists('tb_bookingevent');
    }
}
