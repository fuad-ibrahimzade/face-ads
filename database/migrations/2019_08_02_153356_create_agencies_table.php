<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //            $table->foreign('name')->references('name')->on('users');
//            $table->foreign('email')->references('email')->on('users');
            $table->string('email');
            $table->unsignedInteger('budget_spent_freelancer');
            $table->string('worker_email_freelancer');
//            $table->foreign('worker_email_af')->references('email')->on('users');
            $table->unsignedInteger('rating_freelancer')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
