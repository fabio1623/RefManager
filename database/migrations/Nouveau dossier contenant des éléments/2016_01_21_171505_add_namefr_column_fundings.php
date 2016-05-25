<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNamefrColumnFundings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->string('name_fr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->dropColumn('name_fr');
        });
    }
}
