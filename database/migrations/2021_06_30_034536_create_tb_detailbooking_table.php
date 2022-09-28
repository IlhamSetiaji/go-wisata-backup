<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailbookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detailbooking', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->references('kode')->on('tb_tiket')->nullable();
            $table->string('kode_booking')->nullable();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tempat_name');
            $table->string('checkin');
            $table->string('checkinn')->nullable();
            $table->string('checkout');
            $table->string('checkoutt')->nullable();
            $table->string('jumlah_orang');
            $table->foreignId('kamar_id')->constrained('tb_kamar')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah_kamar');
            $table->integer('durasi');
            $table->integer('subtotal');
            $table->integer('status');
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
        Schema::dropIfExists('tb_detailbooking');
    }
}
