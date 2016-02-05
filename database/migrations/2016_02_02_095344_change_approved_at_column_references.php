<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeApprovedAtColumnReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropColumn('approved_at');
        });

        Schema::table('references', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropColumn('approved_at');
        });

        Schema::table('references', function (Blueprint $table) {
            $table->date('approved_at')->nullable();
        });
    }
}
