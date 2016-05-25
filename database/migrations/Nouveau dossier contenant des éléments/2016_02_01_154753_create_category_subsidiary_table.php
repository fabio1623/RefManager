<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySubsidiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_subsidiary', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('subsidiary_id')->unsigned();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_subsidiary');
    }
}
