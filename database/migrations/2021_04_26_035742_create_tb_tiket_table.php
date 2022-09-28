<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->index()->nullable();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onUpdate('cascade')->onDelete('cascade')->NULL;
            $table->string('check')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->integer('harga');
            $table->integer('status')->nullable()->default(0);
            $table->timestamps();
            $table->string('token')->nullable();
            $table->integer('type_bayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_tiket');
    }
}
