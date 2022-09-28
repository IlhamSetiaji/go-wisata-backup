<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_event', function (Blueprint $table) {
            $table->id();
            $table->string('kode_event');
            $table->string('nama');
            $table->longText('deskripsi');
            $table->string('lokasi');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->string('tgl_buka');
            $table->string('tgl_tutup');
            $table->string('harga');
            $table->string('foto');
            $table->string('link_video')->nullable();
            $table->integer('kapasitas_awal');
            $table->integer('kapasitas_akhir')->default(0);
            $table->integer('status')->default(1);
            $table->foreignId('kategorievent_id');
            $table->string('user_id')->references('petugas_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_event');
    }
}
