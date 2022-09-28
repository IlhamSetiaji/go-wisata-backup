<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbWahanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_wahana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('harga')->nullable();
            $table->integer('status')->default(1);
            $table->string('kode_wahana')->nullable();
            $table->timestamps();
            $table->string('deskripsi_harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_wahana');
    }
}
