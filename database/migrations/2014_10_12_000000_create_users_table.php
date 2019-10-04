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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
//            $table->string('user_made_login_token')->nullable();
            $table->string('customer_type')->nullable();//ya sahibkar(Entrepreneur) ya freelancer ya agentlik yeni ya E ya F ya A

            $table->string('profile_image')->nullable();
            $table->string('activity')->nullable();
//            $table->string('sector');
            $table->json('sector')->nullable();
            $table->json('pricing')->nullable();
            $table->json('pricing2')->nullable();
            $table->json('pricing3')->nullable();
            $table->json('social_links')->nullable();

            $table->string('currency')->nullable()->default('AZN');
            $table->string('city')->nullable();

//            $table->string('remember_token')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('password_reset_token')->nullable();


            $table->string('street')->nullable();
			
			$table->string('type')->default('default');

            $table->rememberToken();
            $table->timestamps();
//            email_verified_at     bidene bu idi originalda nullable
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
