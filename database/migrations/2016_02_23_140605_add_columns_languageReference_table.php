<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsLanguageReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_reference', function (Blueprint $table) {
            $table->string('country');
            $table->string('location');
            $table->text('team');
            $table->string('customer_address');
            $table->text('staff');
            $table->text('consultants');
        });

        Schema::table('language_reference', function (Blueprint $table) {
            $table->dropColumn(['financing', 'experts']);
        });

        Schema::table('language_reference', function (Blueprint $table) {
            $table->text('financing');
            $table->text('experts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_reference', function (Blueprint $table) {
            $table->dropColumn(['country', 'localisation', 'team', 'customer_address', 'staff', 'consultants']);
            $table->dropColumn(['financing', 'experts']);
        });

        Schema::table('language_reference', function (Blueprint $table) {
            $table->string('financing');
            $table->string('experts');
        });
    }
}
