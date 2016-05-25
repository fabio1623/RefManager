<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZoneAndCurrencyColumnsInReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->enum('currency', ['Euros', 'Dollars']);
            $table->string('rate');

            $table->integer('zone')->unsigned()->nullable();
            $table->foreign('zone')->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign('references_zone_foreign');
            
            $table->dropColumn(['currency', 'rate', 'zone']);
        });
    }
}
