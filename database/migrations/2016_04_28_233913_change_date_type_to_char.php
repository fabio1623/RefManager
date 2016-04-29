<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateTypeToChar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_reference', function (Blueprint $table) {
            $table->char('start_date', 7)->change();
            $table->char('end_date', 7)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_reference', function (Blueprint $table) {
            $table->string('start_date', 7)->change();
            $table->string('end_date', 7)->change();
        });
    }
}
