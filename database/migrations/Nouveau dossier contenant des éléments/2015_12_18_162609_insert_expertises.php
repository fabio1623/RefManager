<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Expertise;
use App\Domain;

class InsertExpertises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('domain_expertise');

        Schema::table('expertises', function (Blueprint $table) {
            $table->integer('parent_expertise_id')->unsigned()->nullable();
            $table->foreign('parent_expertise_id')->references('id')->on('expertises');

            $table->integer('domain_id')->unsigned()->nullable();
            $table->foreign('domain_id')->references('id')->on('domains');
        });

        $domains = array(
                array("Resources", "Hydrogeology / wells", "Hydrology / surface water"),
                array("Energy", "Electric network", "Urban heating network", "Renewable energy (wind power, solar, geothermal)", "Energy efficiency", "Carbon balance"),
                array("Drinking water", "Drinking water treatment", "Surface water", "Underground water", "Desalination", "Drinking water pipeline system", "Transport mains", "Distribution mains", "Unaccounted for water / leaks", "Network modelling", "Water quality in the pipeline system", "Service reservoirs", "Pumping", "Process water treatment"),
                array("Waste management", "Collection", "Sorting, recycling, material recovery", "Landfill", "Hazardous waste, insdustrial wastes", "Incineration, waste to energy"),
                array("Environment", "Environmental impact study", "Environmental management system (ISO 14000)", "Biomass", "Environmental audit"),
                array("Wastewater", "Wastewater network", "Rain water sewers", "Gravity sewers", "Vacuum sewers", "Pressure sewers", "Network modelling", "Wastewater treatment", "Conventional plant", "Non convential plant (biofilters, MBR)", "Industrial wastewater", "Wastewater reuse", "Sludge management", "Pumping"),
                array("Utilities", "Installations audit / diagnostic", "Operation / maintenance", "Quality management", "Health and safety management", "Legal / contractual", "Organisation and human resources", "Customer services", "Financial analysis", "Tariff analysis", "Asset management", "Geographical information system"),
                array("Demand studies", "Demographic / socio-economic", "Urbanistic", "Evolution of the demand"),
                array("Other", "Rural", "Agro / irrigation", "Industrial")
            );

        for ($i=0; $i < count($domains); $i++) { 
            $domain_name = $domains[$i][0];
            $domain_in_db = Domain::where('name', $domain_name)->first();

            for ($j=1; $j < count($domains[$i]); $j++) { 
                $new_expertise = new Expertise;
                $new_expertise->name = $domains[$i][$j];               
                $new_expertise->domain_id = $domain_in_db->id;

                if ($domain_name == "Drinking water" && ($domains[$i][$j] == "Surface water" || $domains[$i][$j] == "Underground water" || $domains[$i][$j] == "Desalination")) {
                    $expertise_in_db = Expertise::where('name', 'Drinking water treatment')->first();
                    $new_expertise->parent_expertise_id = $expertise_in_db->id;
                }

                if ($domain_name == "Drinking water" && ($domains[$i][$j] == "Transport mains" || $domains[$i][$j] == "Distribution mains" || $domains[$i][$j] == "Unaccounted for water / leaks" || $domains[$i][$j] == "Network modelling" || $domains[$i][$j] == "Water quality in the pipeline system")) {
                    $expertise_in_db = Expertise::where('name', 'Drinking water pipeline system')->first();
                    $new_expertise->parent_expertise_id = $expertise_in_db->id;
                }

                if ($domain_name == "Wastewater" && ($domains[$i][$j] == "Rain water sewers" || $domains[$i][$j] == "Gravity sewers" || $domains[$i][$j] == "Vacuum sewers" || $domains[$i][$j] == "Pressure sewers" || $domains[$i][$j] == "Network modelling")) {
                    $expertise_in_db = Expertise::where('name', 'Wastewater network')->first();
                    $new_expertise->parent_expertise_id = $expertise_in_db->id;
                }
                
                if ($domain_name == "Wastewater" && ($domains[$i][$j] == "Conventional plant" || $domains[$i][$j] == "Non convential plant (biofilters, MBR)" || $domains[$i][$j] == "Industrial wastewater" || $domains[$i][$j] == "Wastewater reuse")) {
                    $expertise_in_db = Expertise::where('name', 'Wastewater treatment')->first();
                    $new_expertise->parent_expertise_id = $expertise_in_db->id;
                }                

                $new_expertise->save();
            }
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expertises', function (Blueprint $table) {
            $table->dropForeign('expertises_parent_expertise_id_foreign');
            $table->dropForeign('expertises_domain_id_foreign');

            $table->dropColumn('parent_expertise_id');
            $table->dropColumn('domain_id');
        });

        /*DB::table('expertises')->truncate();*/
        DB::table('expertises')->delete();

        Schema::create('domain_expertise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->foreign('domain_id')->references('id')->on('domains');
            $table->integer('expertise_id')->unsigned();
            $table->foreign('expertise_id')->references('id')->on('expertises');
        });
    }
}
