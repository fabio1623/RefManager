<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalServiceReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_service_reference', function (Blueprint $table) {
            $table->integer('internal_service_id')->unsigned();
            $table->foreign('internal_service_id')->references('id')->on('internal_services');

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
        Schema::table('internal_service_reference', function (Blueprint $table) {
            $table->dropForeign('internal_service_reference_internal_service_id_foreign');
            $table->dropForeign('internal_service_reference_reference_id_foreign');
        });
        Schema::drop('internal_service_reference');
    }
}
