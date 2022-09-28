<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_setting', function (Blueprint $table) {
            $table->id();
            $table->string('home1')->nullable();
            $table->string('about1')->nullable();
            $table->string('about2')->nullable();
            $table->string('video')->nullable();
            $table->string('sponsor1')->nullable();
            $table->string('sponsor2')->nullable();
            $table->string('sponsor3')->nullable();
            $table->string('sponsor4')->nullable();
            $table->string('experience1');
            $table->string('experience2');
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
        Schema::dropIfExists('table_setting');
    }
}
