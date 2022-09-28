<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            // $table->bigIncrements('id');
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('jk')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('image')->nullable();
            $table->string('role_id')->constrained('tb_role')->onUpdate('cascade')->onDelete('cascade')->default(5);
            $table->string('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->string('petugas_id')->index()->nullable();
            $table->integer('desa_id')->nullable();
            $table->integer('tempat_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
