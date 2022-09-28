<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailtransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detailtransaksi', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('durasi')->nullable();
            $table->string('tanggal_a')->nullable();
            $table->string('tanggal_b')->nullable();
            $table->string('kode_tiket')->references('kode')->on('tb_tiket')->nullable();
            $table->string('id_produk')->nullable();
            $table->string('booking_id')->nullable();
            $table->integer('harga')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('status')->nullable();
            $table->string('kedatangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kategori')->nullable();
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_detailtransaksi');
    }
}
