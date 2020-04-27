<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToFormUserInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_user_infos', function (Blueprint $table) {
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_user_infos', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('dob');
        });
    }
}
