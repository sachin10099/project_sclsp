<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmitCardDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admit_card_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_cards_id')->unsigned()->nullable();
            $table->foreign('admin_cards_id')
              ->references('id')->on('admin_cards')
              ->onDelete('cascade');
            $table->string('region_name')->nullable();
            $table->string('documents')->nullable();
            $table->string('official_links')->nullable();
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
        Schema::dropIfExists('admit_card_documents');
    }
}
