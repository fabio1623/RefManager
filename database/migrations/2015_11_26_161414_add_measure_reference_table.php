<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeasureReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure_reference', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('measures');

            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->string('value');
            $table->string('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measure_reference', function (Blueprint $table) {
            $table->dropForeign('measure_reference_measure_id_foreign');
            $table->dropForeign('measure_reference_reference_id_foreign');
        });
        Schema::drop('measure_reference');
    }
}
