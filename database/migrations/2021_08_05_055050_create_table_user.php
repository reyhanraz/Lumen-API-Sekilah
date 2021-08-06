<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nama',100);
            $table->String('email',100)->unique();
            $table->String('password',100);
            $table->String('foto')->nullable();
            $table->String('alamat',100)->nullable();
            $table->String('noTelp',20)->nullable();
            $table->String('sekolahAsal',100)->nullable();
            $table->String('namaOrtu',100)->nullable();
            $table->String('api_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
