<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMMServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_m_services', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->increments('id');
            $table->timestamps();

            $table->string('email')->nullable();


            $table->string('pricing')->nullable();
            $table->string('services_for_price')->nullable();

            $table->string('business_mark_id')->nullable();
            $table->string('business_mark_name')->nullable();

            $table->string('work_start')->nullable();
            $table->string('work_end')->nullable();
//            $table->unsignedBigInteger('business_mark_id');
//            $table->bigInteger('business_mark_id')->unsigned()->nullable();
//            $table->unsignedInteger('business_mark_id')->nullable();
//            $table->foreign('business_mark_id')->references('id')->on('business_marks');

//            $table->foreign('worker_email_af')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_m_services');
    }
}
