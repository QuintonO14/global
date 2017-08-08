<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('firstname', '20');
            $table->string('lastname', '20');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country_living');
            $table->string('country_from');
            $table->string('gender');
            $table->string('job', '15')->default('None');
            $table->string('status', '100')->default('Global is awesome!');
            $table->integer('photo_id')->nullable()->unsigned();
            $table->integer('cover_id')->nullable()->unsigned();
            $table->rememberToken();
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
