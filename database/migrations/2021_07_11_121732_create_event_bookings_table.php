<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_bookings', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->foreignId('kamar_id')->constrained('tb_kamar')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->string('date')->nullable();
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_tiket')->references('kode')->on('tb_tiket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_bookings');
    }
}
