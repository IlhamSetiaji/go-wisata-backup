<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pakets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kamar')->constrained('tb_kamar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_villa')->constrained('tb_villa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_desa');
            $table->string('nama_paket');
            $table->string('jml_hari')->nullable();
            $table->string('jml_orang')->nullable();
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
        Schema::dropIfExists('tb_pakets');
    }
}