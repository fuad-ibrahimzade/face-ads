<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomAnalyticsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_analytics_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

//            $table->string('visited_page_link')->nullable();
//            $table->string('user_ip')->nullable();
//            $table->string('country')->nullable();
//            $table->string('http_referer')->nullable();
//            $table->json('ip_data')->nullable();

            $table->string('analytics_type')->nullable();
            $table->json('analytics_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_analytics_infos');
    }
}
