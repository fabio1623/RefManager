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
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign('locations_country_id_foreign');
            $table->dropColumn('country_id');
        });
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign('references_location_id_foreign');
            $table->dropColumn('location_id');
        });
        Schema::dropIfExists('locations');
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
        if (Schema::hasTable('users')) {
            //
        }
        else {
            Schema::create('locations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
        Schema::table('countries', function (Blueprint $table) {
            if (Schema::hasColumn('countries', 'zone_id')) {
                //
            }
            else {
                $table->integer('zone_id')->unsigned();
                $table->foreign('zone_id')->references('id')->on('zones');
            }
        });
        Schema::table('locations', function (Blueprint $table) {
            if (Schema::hasColumn('locations', 'country_id')) {
                //
            }
            else {
                $table->integer('country_id')->unsigned();
                $table->foreign('country_id')->references('id')->on('countries');
            }
        });
        Schema::table('references', function (Blueprint $table) {
            if (Schema::hasColumn('references', 'location_id')) {
                //
            }
            else {
                $table->integer('location_id')->unsigned();
                $table->foreign('location_id')->references('id')->on('locations');
            }
        });
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign('references_country_id_foreign');
            $table->dropColumn('country_id');
        });
    }
}
