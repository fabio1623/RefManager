<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceSubServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_sub_service', function (Blueprint $table) {
            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->integer('sub_service_id')->unsigned();
            $table->foreign('sub_service_id')->references('id')->on('sub_services');

            $table->boolean('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reference_sub_service', function (Blueprint $table) {
            $table->dropForeign('reference_sub_service_reference_id_foreign');
            $table->dropForeign('reference_sub_service_sub_service_id_foreign');
        });
        Schema::drop('reference_sub_service');
    }
}
