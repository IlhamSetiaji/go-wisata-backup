<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasiRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasi_rekening', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->string('debit')->nullable();
            $table->string('kredit')->nullable();
            $table->string('keterangan', 250)->nullable();
            $table->string('saldo')->nullable();
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
        Schema::dropIfExists('mutasi_rekening');
    }
}
