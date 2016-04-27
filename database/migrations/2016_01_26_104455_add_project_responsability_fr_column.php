<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectResponsabilityFrColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contributor_reference', function (Blueprint $table) {
            $table->string('responsability_on_project_fr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contributor_reference', function (Blueprint $table) {
            $table->dropColumn('responsability_on_project_fr');
        });
    }
}
