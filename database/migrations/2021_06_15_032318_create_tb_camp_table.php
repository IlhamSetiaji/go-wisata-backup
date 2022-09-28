<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_camp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->integer('jumlah')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('image')->nullable();
            $table->string('harga')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->string('kode_camp');
            $table->string('deskripsi_harga')->nullable();
            $table->string('kategori')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_camp');
    }
}
