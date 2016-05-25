<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubsidiaryColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('subsidiary_id')->unsigned()->nullable();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_subsidiary_id_foreign');
            $table->dropColumn('subsidiary_id');
        });
    }
}
