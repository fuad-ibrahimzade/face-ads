<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_marks', function (Blueprint $table) {
            $table->increments('id');
//            $table->increments('id');
            $table->timestamps();

            $table->string('email');
//            $table->foreign('email')->references('email')->on('users');

            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->json('sector')->nullable();
            $table->string('activity')->nullable();
            $table->string('pricing')->nullable();
            $table->string('profile_image')->nullable();

            $table->string('smmservice_id')->nullable();
//            $table->bigInteger('smmservice_id')->unsigned()->nullable();

//            $table->foreign('id')->references('business_mark_id')->on('s_m_m_services');  error mazgi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_marks');
    }
}
