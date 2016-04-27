<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalServiceReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_service_reference', function (Blueprint $table) {
            $table->integer('external_service_id')->unsigned();
            $table->foreign('external_service_id')->references('id')->on('external_services');

            $table->integer('reference_id')->unsigned();
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
        Schema::table('external_service_reference', function (Blueprint $table) {
            $table->dropForeign('external_service_reference_external_service_id_foreign');
            $table->dropForeign('external_service_reference_reference_id_foreign');
        });
        Schema::drop('external_service_reference');
    }
}
