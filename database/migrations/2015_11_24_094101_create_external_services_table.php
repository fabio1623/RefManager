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

            $table->integer('subservice_id')->unsigned()->nullable();
            $table->foreign('subservice_id')->references('id')->on('external_services');
        });

        $external_services = array("Master plan", "Feasibility of identification study", "Preliminary design", "Detailed design", "Preparation of tender documents", "Analysis and evaluation of tenders", "Site supervision", "FIDIC", "Technical assistance", "Training", "Reinforcement of capacity", "Financial, tariff and institutional analysis (audit, due diligence, FOPIP, etc)", "Analysis costs-benefits", "Institutional (PPP study, sectorial restructuring, regulation, etc)");

        foreach ($external_services as $service) {
            $new_service = new ExternalService;
            $new_service->name = $service;
        
            $new_service->save();
        }

        for ($i=0; $i < count($external_services)-1; $i++) { 
            if ($external_services[$i] == "Site supervision") {
                $service_to_update = ExternalService::find($i+1);
                
                $subservice = ExternalService::where('name', "FIDIC")->first();                
                
                $service_to_update->subservice_id = $subservice->id;

                $service_to_update->save();
            }
            if ($external_services[$i] == "Financial, tariff and institutional analysis (audit, due diligence, FOPIP, etc)") {
                $service_to_update = ExternalService::find($i+1);
                
                $subservice = ExternalService::where('name', "Analysis costs-benefits")->first();                
                
                $service_to_update->subservice_id = $subservice->id;

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
            $table->dropForeign('external_services_subservice_id_foreign');
        });
        Schema::drop('external_services');
    }
}
