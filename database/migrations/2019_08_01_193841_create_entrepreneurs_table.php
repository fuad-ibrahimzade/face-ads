<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrepreneursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepreneurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

//            $table->foreign('name')->references('name')->on('users');
//            $table->foreign('email')->references('email')->on('users');
            $table->string('email');
            $table->unsignedInteger('budget_spent');
            $table->string('worker_email_af');
//            $table->foreign('worker_email_af')->references('email')->on('users');
            $table->unsignedInteger('rating_af')->nullable();
            $table->dateTime('started_work');
            $table->dateTime('finished_work');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrepreneurs');
    }
}
