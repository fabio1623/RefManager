<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Category;

class InsertCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = array("Water", "Wastewater", "Energy", "Waste", "Air");

        foreach ($categories as $category) {
            $new_category = new Category;
            $new_category->name = $category;
        
            $new_category->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_measure', function (Blueprint $table) {
            $table->dropForeign('category_measure_category_id_foreign');
        });
        DB::table('categories')->truncate();
    }
}
