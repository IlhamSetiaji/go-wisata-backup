<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TourGuide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_guide', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->references('id')->on('tb_tempat')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('telp');
            $table->string('email');
            $table->string('foto');
            $table->string('harga');
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
        Schema::dropIfExists('tour_guide');
    }
}
