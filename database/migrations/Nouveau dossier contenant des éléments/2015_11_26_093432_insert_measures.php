<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Category;
use App\Measure;

class InsertMeasures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('category_measure');

        Schema::table('measures', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->enum('field_type', ['Not selected', 'Input', 'Option', 'Select', 'Checkbox', 'Textarea']);
        });

        $categories = array(
                array("Water", "Number of inhabitants", "Number of subscribers", "Installed capacity", "Length of the network"),
                array("Wastewater", "Number of inhabitants", "Number of subscribers", "Installed capacity", "Length of the network"),
                array("Energy", "Number of inhabitants", "Number of subscribers", "Installed capacity", "Network MT (Electric)", "Primary network (Heat)", "Secondary network (Heat)"),
                array("Waste", "Number of inhabitants", "Installed capacity"),
                array("Air", "Number of inhabitants", "Number of subscribers", "Installed capacity", "Length of the network", "Number of buildings", "Surface", "Accomodation capacity", "Number of systems (productions, power plants, etc)")
            );

        for ($i=0; $i < count($categories); $i++) { 
            $category_name = $categories[$i][0];
            $category_in_db = Category::where('name', $category_name)->first();

            for ($j=1; $j < count($categories[$i]); $j++) { 
                $new_measure = new Measure;
                $new_measure->name = $categories[$i][$j];               
                $new_measure->category_id = $category_in_db->id;

                if ($categories[$i][$j] == "Network MT (Electric)" || $categories[$i][$j] == "Primary network (Heat)" || $categories[$i][$j] == "Secondary network (Heat)") {
                    $new_measure->field_type = "Checkbox";
                }
                else {
                    $new_measure->field_type = "Input";
                }     

                $new_measure->save();
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
        Schema::table('measures', function (Blueprint $table) {
            $table->dropForeign('measures_category_id_foreign');
            $table->dropColumn('category_id');

            $table->dropColumn('field_type');
        });

        DB::table('measures')->truncate();

        Schema::create('category_measure', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('measures');
        });
    }
}
