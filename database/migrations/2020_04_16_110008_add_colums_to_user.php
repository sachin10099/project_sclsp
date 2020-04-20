<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('profile_completed', ['Yes', 'No'])->default('No');
            $table->string('postal_code')->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
              ->references('id')->on('cities')
              ->onDelete('cascade');
            $table->enum('accept_terms', ['Yes', 'No'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_completed');
            $table->dropColumn('postal_code');
            $table->dropColumn('city_id');
            $table->dropColumn('accept_terms');
        });
    }
}
