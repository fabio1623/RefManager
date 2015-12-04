<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrencyManagement extends Migration
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

            $table->dropForeign('references_zone_id_foreign');
            $table->dropColumn('zone_id');
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
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones');

            $table->dropForeign('references_zone_foreign');
            
            $table->dropColumn(['currency', 'rate', 'zone']);
        });
    }
}
