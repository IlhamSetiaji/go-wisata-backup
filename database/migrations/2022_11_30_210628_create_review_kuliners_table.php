<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewKulinersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_kuliners', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->string('kode_tiket');
            $table->string('kuliner_id')->nullable();
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
        Schema::dropIfExists('review_kuliners');
    }
}
