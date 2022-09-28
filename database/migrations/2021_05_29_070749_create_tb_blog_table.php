<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_blog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kategori');
            $table->string('judul');
            $table->longText('konten')->nullable();
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
        Schema::dropIfExists('tb_blog');
    }
}
