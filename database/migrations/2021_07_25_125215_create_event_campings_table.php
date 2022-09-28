<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCampingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_campings', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('camp_id');
            $table->string('kode');
            $table->string('date');
            $table->foreignId('tempat_id')->constrained('tb_tempat')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('event_camping');
    }
}
