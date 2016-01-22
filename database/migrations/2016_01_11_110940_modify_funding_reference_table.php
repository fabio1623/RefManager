<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFundingReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funding_reference', function (Blueprint $table) {
            $table->integer('funding_id')->unsigned();
            $table->foreign('funding_id')->references('id')->on('fundings');

            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funding_reference', function (Blueprint $table) {
            $table->increments('id');
            $table->dropColumn(['funding_id', 'reference_id']);
        });
    }
}
