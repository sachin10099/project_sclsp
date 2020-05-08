<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToAppliedJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applied_jobs', function (Blueprint $table) {
            $table->string('order_id')->nullable()->after('id');
            $table->bigInteger('accepted_by')->unsigned()->nullable()->after('job_id');
            $table->foreign('accepted_by')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->longText('rejection_region')->nullable();
            $table->enum('verified_by_user', ['Yes', 'No'])->default('No');
            $table->longText('user_query')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applied_jobs', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('accepted_by');
            $table->dropColumn('rejection_region');
            $table->dropColumn('verified_by_user');
            $table->dropColumn('user_query');
        });
    }
}
