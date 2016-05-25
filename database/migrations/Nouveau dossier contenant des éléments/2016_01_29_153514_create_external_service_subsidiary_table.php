<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalServiceSubsidiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_service_subsidiary', function (Blueprint $table) {
            $table->integer('external_service_id')->unsigned();
            $table->foreign('external_service_id')->references('id')->on('external_services');

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
        Schema::drop('external_service_subsidiary');
    }
}
