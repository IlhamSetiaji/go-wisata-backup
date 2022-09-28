<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailcampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detailcamp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->references('kode')->on('tb_tiket')->nullable();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tempat_name');
            $table->string('date');
            $table->string('date2')->nullable();
            $table->string('jumlah_orang');
            $table->string('makan');
            $table->string('durasi');
            $table->string('alat_id')->nullable();
            $table->string('jumlah_tenda')->nullable();
            $table->integer('makan_durasi')->nullable();
            $table->string('harga');
            $table->integer('status')->default(0);
            $table->string('tgl_kembaliin')->nullable();
            $table->string('kode_camping');
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
        Schema::dropIfExists('tb_detailcamp');
    }
}
