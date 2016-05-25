<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubServiceServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_service_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_service_id')->unsigned();
            $table->foreign('sub_service_id')->references('id')->on('sub_services');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sub_service_service');
    }
}
