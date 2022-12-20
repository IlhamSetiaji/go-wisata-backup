<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_paket', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket');
            $table->string('kode_booking');
            $table->string('name');
            $table->string('email');
            $table->string('telp');
            $table->string('jml_orang');
            $table->string('jml_hari');
            $table->string('totalbiaya')->nullable();
            $table->integer('status')->default(0);
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
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
        Schema::dropIfExists('booking_paket');
    }
}
