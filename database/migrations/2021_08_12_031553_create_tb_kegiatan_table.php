<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kegiatan');
            $table->string('name');
            $table->string('deskripsi');
            $table->string('harga');
            $table->string('image');
            $table->string('date_a');
            $table->string('date_b');
            $table->string('jambuka');
            $table->string('jamtutup');
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('status')->default(0);
            $table->integer('kapasitas');
            $table->integer('kapasitas_b')->default(0);
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
        Schema::dropIfExists('tb_kegiatan');
    }
}
