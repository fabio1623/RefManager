<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_reference', function (Blueprint $table) {
            $table->integer('activity_id')->unsigned();
            $table->integer('reference_id')->unsigned();

            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('reference_id')->references('id')->on('references');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_reference');
    }
}
