<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            
            //Description panel
            $table->string('project_number');
            $table->boolean('confidential')->default(false);
            $table->string('dfac_name');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('estimated_duration');

            //Details panel with translations
            $table->string('project_name');
            $table->string('project_name_fr');
            $table->string('project_name_es');
            $table->string('project_name_pt');

            $table->string('service_name')->nullable();
            $table->string('service_name_fr')->nullable();
            $table->string('service_name_es')->nullable();
            $table->string('service_name_pt')->nullable();

            $table->text('project_description')->nullable();
            $table->text('project_description_fr')->nullable();
            $table->text('project_description_es')->nullable();
            $table->text('project_description_pt')->nullable();

            $table->text('service_description')->nullable();
            $table->text('service_description_fr')->nullable();
            $table->text('service_description_es')->nullable();
            $table->text('service_description_pt')->nullable();

            $table->integer('staff_number')->nullable();

            $table->float('seureca_man_months')->nullable();
            $table->float('consultants_man_months')->nullable();

            $table->integer('contact_id')->unsigned()->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->float('total_project_cost')->nullable();
            $table->float('seureca_services_cost')->nullable();
            $table->float('work_cost')->nullable();

            $table->text('general_comments');

            $table->timestamps();

            $table->string('created_by');
            $table->string('updated_by');

            $table->boolean('dcom_approval')->default(false);

            $table->date('approved_at')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('references');
    }
}
