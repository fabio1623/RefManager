<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Domain;

class InsertDomains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $domains = array("Resources", "Energy", "Drinking water","Waste management", "Wastewater", "Environment", "Utilities", "Demand studies", "Other");

        foreach ($domains as $domain) {
            $new_domain = new Domain;
            $new_domain->name = $domain;
        
            $new_domain->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domain_expertise', function (Blueprint $table) {
            $table->dropForeign('domain_expertise_domain_id_foreign');
        });
        DB::table('domains')->truncate();
    }
}
