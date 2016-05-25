<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Measure;
use App\Qualifier;

class CreateQualifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('field_type', ['Not selected', 'Input', 'Option', 'Select', 'Checkbox', 'Textarea']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('measure_qualifier', function (Blueprint $table) {
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('measures');

            $table->integer('qualifier_id')->unsigned();
            $table->foreign('qualifier_id')->references('id')->on('qualifiers');
        });

        $measures_to_delete = Measure::where('name', 'Network MT (Electric)')
                                        ->orWhere('name', 'Primary network (Heat)')
                                        ->orWhere('name', 'Secondary network (Heat)')
                                            ->get();

        foreach ($measures_to_delete as $measure) {
            Measure::destroy($measure->id);
        }

        $qualifiers_to_add = array("Network MT (Electric)", "Primary network (Heat)", "Secondary network (Heat)");

        foreach ($qualifiers_to_add as $qualifier) {
            $new_qualifier = new Qualifier;
            $new_qualifier->name = $qualifier;
            $new_qualifier->field_type = "Checkbox";
        
            $new_qualifier->save();

            $measure_to_attach = Measure::where('name', 'Installed capacity')
                                            ->where('category_id', 3)->first();

            $new_qualifier->measures()->attach($measure_to_attach->id);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $measures_to_add = array("Network MT (Electric)", "Primary network (Heat)", "Secondary network (Heat)");

        foreach ($measures_to_add as $measure) {
            $new_measure = new Measure;
            $new_measure->name = $measure;
            $new_measure->field_type = 'Checkbox';
            $new_measure->category_id = 3;
        
            $new_measure->save();
        }

        Schema::table('measure_qualifier', function (Blueprint $table) {
            $table->dropForeign('measure_qualifier_measure_id_foreign');
            $table->dropForeign('measure_qualifier_qualifier_id_foreign');
        });
        Schema::dropIfExists('measure_qualifier');
        Schema::dropIfExists('qualifiers');
    }
}
