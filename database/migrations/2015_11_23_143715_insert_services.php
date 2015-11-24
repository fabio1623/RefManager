<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Service;
use App\SubService;

class InsertServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $external_services = array("Master plan", "Feasibility of identification study", "Preliminary design");
        $internal_services = array("Technical assistance", "Public - Private partnership", "Management contract");

        $external_panel = Service::find(1);
        $internal_panel = Service::find(2);

        foreach ($external_services as $ext_service) {
            $new_ext_service = new SubService;
            $new_ext_service->service_name = $ext_service;
        
            $new_ext_service->save();

            $external_panel->subServices()->attach($new_ext_service->id);
        }

        foreach ($internal_services as $int_service) {
            $new_int_service = new SubService;
            $new_int_service->service_name = $int_service;
        
            $new_int_service->save();

            $internal_panel->subServices()->attach($new_int_service->id);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $external_services = SubService::all();
        $internal_services = SubService::all();

        foreach ($external_services as $ext_service) {
            $ext_service->services()->detach();
            SubService::destroy($ext_service->id);
        }

        foreach ($internal_services as $int_service) {
            $int_service->services()->detach();
            SubService::destroy($int_service->id);
        }
    }
}
