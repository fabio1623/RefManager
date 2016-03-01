<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageSubsidiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_subsidiary', function (Blueprint $table) {
            $table->integer('subsidiary_id')->unsigned();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('language_subsidiary');
    }
}
