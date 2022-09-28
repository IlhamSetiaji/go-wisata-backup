<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKulinerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kuliner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('kategori')->nullable();
            $table->string('harga')->nullable();
            $table->string('deskripsi')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->string('kode_kuliner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kuliner');
    }
}
