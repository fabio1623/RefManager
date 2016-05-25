<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualifierReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifier_reference', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('qualifier_id')->unsigned();
            $table->foreign('qualifier_id')->references('id')->on('qualifiers');

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
        Schema::table('qualifier_reference', function (Blueprint $table) {
            $table->dropForeign('qualifier_reference_qualifier_id_foreign');
            $table->dropForeign('qualifier_reference_reference_id_foreign');
        });
        Schema::drop('qualifier_reference');
    }
}
