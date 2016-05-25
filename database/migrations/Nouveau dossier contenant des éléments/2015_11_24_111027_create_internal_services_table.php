<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\InternalService;

class CreateInternalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->integer('parent_service_id')->unsigned()->nullable();
            $table->foreign('parent_service_id')->references('id')->on('internal_services');
        });

        $internal_services = array("Technical assistance", "Public - Private partnership", "Management contract", "Lease contract", "Concession contract", "Complete divestiture", "Major projects", "BOT, BOOT", "D&B (VWS)");

        foreach ($internal_services as $service) {
            $new_service = new InternalService;
            $new_service->name = $service;
        
            $new_service->save();
        }

        for ($i=0; $i < count($internal_services)-1; $i++) { 
            if ($internal_services[$i] == "Management contract" || $internal_services[$i] == "Lease contract" || $internal_services[$i] == "Concession contract") {
                $service_to_update = InternalService::find($i+1);
                
                $parent_service = InternalService::where('name', "Public - Private partnership")->first();                
                
                $service_to_update->parent_service_id = $parent_service->id;

                $service_to_update->save();
            }
            if ($internal_services[$i] == "BOT, BOOT" || $internal_services[$i] == "D&B (VWS)") {
                $service_to_update = InternalService::find($i+1);
                
                $parent_service = InternalService::where('name', "Major projects")->first();                
                
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
        Schema::table('internal_services', function (Blueprint $table) {
            $table->dropForeign('internal_services_parent_service_id_foreign');
        });
        Schema::drop('internal_services');
    }
}
