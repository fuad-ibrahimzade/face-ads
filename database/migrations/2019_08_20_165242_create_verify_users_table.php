<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('verify_users', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->timestamps();
//        });
        Schema::create('verify_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('email');
            $table->string('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verify_users');
    }
}
