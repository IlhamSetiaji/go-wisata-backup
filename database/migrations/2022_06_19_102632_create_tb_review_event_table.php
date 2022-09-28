<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbReviewEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_review_event', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->string('kode_tiket');
            $table->foreignId('event_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('tb_review_event');
    }
}
