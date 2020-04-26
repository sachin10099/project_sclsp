<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->string('job_title');
            $table->longText('job_desc');
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->foreign('state_id')
              ->references('id')->on('states')
              ->onDelete('cascade');
            $table->string('job_location');
            $table->string('job_type');
            $table->dateTime('job_published')->nullable();
            $table->dateTime('job_deadline')->nullable();
            $table->bigInteger('vacancy')->nullable();
            $table->string('feature_image')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
