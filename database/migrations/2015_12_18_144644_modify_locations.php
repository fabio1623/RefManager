<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropForeign('countries_zone_id_foreign');
            $table->dropColumn('zone_id');
        });

        Schema::table('references', function (Blueprint $table) {
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones');
        });

        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign('references_country_id_foreign');
            $table->dropColumn('country_id');
        });
    }
}
