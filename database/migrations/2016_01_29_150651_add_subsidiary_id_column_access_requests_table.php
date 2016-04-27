<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubsidiaryIdColumnAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_requests', function (Blueprint $table) {
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
        Schema::table('access_requests', function (Blueprint $table) {
            $table->dropForeign('access_requests_subsidiary_id_foreign');
            $table->dropColumn('subsidiary_id');
        });
    }
}
