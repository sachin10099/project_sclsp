<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobRelatedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_related_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('applied_job_id')->unsigned()->nullable();
            $table->foreign('applied_job_id')
              ->references('id')->on('applied_jobs')
              ->onDelete('cascade');
            $table->string('document_name')->nullable();
            $table->string('document_file')->nullable();
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
        Schema::dropIfExists('job_related_documents');
    }
}
