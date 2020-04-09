<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilePicColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_pic')->after('name')->nullable();
            $table->string('contact_number')->after('profile_pic')->nullable();
            $table->string('address')->after('contact_number')->nullable();
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
            $table->dropColumn('profile_pic');
            $table->dropColumn('contact_number');
            $table->dropColumn('address');
        });
    }
}
