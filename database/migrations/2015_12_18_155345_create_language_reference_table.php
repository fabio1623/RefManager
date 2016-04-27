<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_reference', function (Blueprint $table) {
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');

            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->string('project_name')->nullable();
            $table->text('project_description')->nullable();
            $table->string('service_name')->nullable();
            $table->text('service_description')->nullable();
            $table->string('experts')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_department')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('client')->nullable();
            $table->string('financing')->nullable();
            $table->text('general_comments')->nullable();
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
            $table->dropForeign('language_reference_language_id_foreign');
            $table->dropForeign('language_reference_reference_id_foreign');
        });
        Schema::drop('language_reference');
    }
}
