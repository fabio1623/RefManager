<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Zone;

class InsertZones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $zones = array('AFE', 'AFO', 'AMNOR', 'ASCC', 'ASE', 'ASU', 'CEI', 'EURO', 'GROUP', 'MAG', 'MO');

            foreach ($zones as $zone) {
                $new_zone = new Zone;
                $new_zone->name = $zone;

                $new_zone->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zones', function (Blueprint $table) {
            DB::table('zones')->delete();
        });
    }
}
