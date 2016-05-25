<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalServiceSubsidiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_service_subsidiary', function (Blueprint $table) {
            $table->integer('internal_service_id')->unsigned();
            $table->foreign('internal_service_id')->references('id')->on('internal_services');

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
        Schema::drop('internal_service_subsidiary');
    }
}
