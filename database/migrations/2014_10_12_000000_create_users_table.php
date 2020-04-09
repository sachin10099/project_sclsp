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
            $table->enum('type', ['admin', 'operator', 'user', 'hotel', 'form_user', 'hotel_user'])->nullable();
            $table->string('email');
            $table->string('password');
            $table->enum('email_verified_at', ['Yes', 'No'])->default('No');
            $table->enum('mobile_verified_at', ['Yes', 'No'])->default('No');
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
