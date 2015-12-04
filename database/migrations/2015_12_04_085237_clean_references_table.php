<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropColumn(['project_name_es', 'project_name_pt', 'service_name_es', 'service_name_pt', 'project_description_es', 'project_description_pt', 'service_description_es', 'service_description_pt']);

            $table->dropForeign('references_country_id_foreign');
            $table->dropColumn('country_id');

            $table->dropForeign('references_contact_id_foreign');
            $table->dropColumn('contact_id');

            $table->dropForeign('references_client_id_foreign');
            $table->dropColumn('client_id');

            $table->string('contact_department');
            $table->string('contact_department_fr');
            $table->string('contact_phone');
            $table->string('contact_email');
        });
        Schema::table('references', function (Blueprint $table) {
            $table->integer('country')->unsigned();
            $table->foreign('country')->references('id')->on('countries');

            $table->integer('contact')->unsigned();
            $table->foreign('contact')->references('id')->on('contacts');

            $table->integer('client')->unsigned()->nullable();
            $table->foreign('client')->references('id')->on('clients');
        });

        Schema::table('clients', function (Blueprint $table) {
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
        Schema::table('references', function (Blueprint $table) {
            $table->string('project_name_es');
            $table->string('project_name_pt');
            $table->string('service_name_es');
            $table->string('service_name_pt');
            $table->text('project_description_es');
            $table->text('project_description_pt');
            $table->text('service_description_es');
            $table->text('service_description_pt');

            $table->dropColumn(['contact_department', 'contact_department_fr', 'contact_phone', 'contact_email']);

            $table->dropForeign('references_country_foreign');
            $table->dropColumn('country');

            $table->dropForeign('references_contact_foreign');
            $table->dropColumn('contact');

            $table->dropForeign('references_client_foreign');
            $table->dropColumn('client');


            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
        });
        
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('name_fr');
        });
    }
}
