<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteOldContinentColumnCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('continent');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->renameColumn('continent_new', 'continent');
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
            $table->renameColumn('continent', 'continent_new');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->enum('continent', ['','Africa', 'America', 'Asia', 'Europe', 'Oceania']);
        });
    }
}
