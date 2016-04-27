<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertiseReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expertise_reference', function (Blueprint $table) {
            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->integer('expertise_id')->unsigned();
            $table->foreign('expertise_id')->references('id')->on('expertises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expertise_reference', function (Blueprint $table) {
            $table->dropForeign('expertise_reference_reference_id_foreign');
            $table->dropForeign('expertise_reference_expertise_id_foreign');
        });
        Schema::dropIfExists('expertise_reference');
    }
}
