<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_reference', function (Blueprint $table) {
            $table->integer('funding_id')->unsigned();
            $table->foreign('funding_id')->references('id')->on('fundings');

            $table->integer('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funding_reference');
    }
}
