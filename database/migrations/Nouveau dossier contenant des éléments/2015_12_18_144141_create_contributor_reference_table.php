<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributorReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributor_reference', function (Blueprint $table) {
            $table->integer('contributor_id')->unsigned();
            $table->foreign('contributor_id')->references('id')->on('contributors');

            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->string('responsability_on_project');
            $table->enum('function_on_project', ['Senior', 'Expert', 'Consultant']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contributor_reference');
    }
}
