<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\ExternalService;

class CreateExternalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->integer('parent_service_id')->unsigned()->nullable();
            $table->foreign('parent_service_id')->references('id')->on('external_services');
        });

        $external_services = array("Master plan", "Feasibility of identification study", "Preliminary design", "Detailed design", "Preparation of tender documents", "Analysis and evaluation of tenders", "Site supervision", "FIDIC", "Technical assistance", "Training", "Reinforcement of capacity", "Financial, tariff and institutional analysis (audit, due diligence, FOPIP, etc)", "Analysis costs-benefits", "Institutional (PPP study, sectorial restructuring, regulation, etc)");

        foreach ($external_services as $service) {
            $new_service = new ExternalService;
            $new_service->name = $service;
        
            $new_service->save();
        }

        for ($i=0; $i < count($external_services)-1; $i++) { 
            if ($external_services[$i] == "FIDIC") {
                $service_to_update = ExternalService::find($i+1);
                
                $parent_service = ExternalService::where('name', "Site supervision")->first();                
                
                $service_to_update->parent_service_id = $parent_service->id;

                $service_to_update->save();
            }
            if ($external_services[$i] == "Analysis costs-benefits") {
                $service_to_update = ExternalService::find($i+1);
                
                $parent_service = ExternalService::where('name', "Financial, tariff and institutional analysis (audit, due diligence, FOPIP, etc)")->first();                
                
                $service_to_update->parent_service_id = $parent_service->id;

                $service_to_update->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('external_services', function (Blueprint $table) {
            $table->dropForeign('external_services_parent_service_id_foreign');
        });
        Schema::drop('external_services');
    }
}
