<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Unit;
use App\Measure;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('measure_unit', function (Blueprint $table) {
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('measures');

            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');
        });

        $units = array("Pop eq", "m³/d", "Mw", "Gcal/h", "Tons", "Sum", "Km", "m²");
        $measures = Measure::all();

        foreach ($units as $unit) {
            $new_unit = new Unit;
            $new_unit->name = $unit;
        
            $new_unit->save();

            switch ($new_unit->name) {
                case 'm³/d':
                    $new_unit->measures()->attach(3);
                    $new_unit->measures()->attach(7);
                    break;
                case 'Kw':
                    $new_unit->measures()->attach(11);
                    break;
                case 'Gcal/h':
                    $new_unit->measures()->attach(11);
                    $new_unit->measures()->attach(16);
                    $new_unit->measures()->attach(19);
                    break;
                case 'Tons':
                    $new_unit->measures()->attach(3);
                    $new_unit->measures()->attach(7);
                    $new_unit->measures()->attach(16);
                    break;
                case 'Sum':
                    $new_unit->measures()->attach(1);
                    $new_unit->measures()->attach(5);
                    $new_unit->measures()->attach(9);
                    $new_unit->measures()->attach(15);
                    $new_unit->measures()->attach(17);
                    break;
                case 'Km':
                    $new_unit->measures()->attach(4);
                    $new_unit->measures()->attach(8);
                    $new_unit->measures()->attach(20);
                    break;
                case 'm²':
                    $new_unit->measures()->attach(22);
                    break;
                default:
                    # code...
                    break;
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
        Schema::table('measure_unit', function (Blueprint $table) {
            $table->dropForeign('measure_unit_measure_id_foreign');
            $table->dropForeign('measure_unit_unit_id_foreign');
        });

        Schema::dropIfExists('measure_unit');

        Schema::dropIfExists('units');
    }
}
