<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTempatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tempat', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->references('petugas_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kategori');
            $table->string('name');
            $table->longText('deskripsi')->nullable();
            $table->string('alamat');
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('sosmed', 500)->nullable();
            $table->longText('galeri')->nullable();
            $table->integer('status')->default(1);
            $table->integer('htm')->default(0);
            $table->timestamps();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('jambuka')->nullable();
            $table->string('jamtutup')->nullable();
            $table->string('gmaps')->nullable();
            $table->integer('dana')->nullable();
            $table->string('induk_id')->default(0)->nullable();
            $table->integer('open')->default(0)->nullable();
            $table->string('video')->nullable();
            $table->string('slug')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tempat');
    }
}
