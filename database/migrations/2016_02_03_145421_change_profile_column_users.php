<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProfileColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('profile', ['Dcom manager', 'User administrator', 'Reference administrator', 'Basic user'])->default('Basic user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('profile', ['User administrator', 'Reference administrator', 'Basic user']);
        });
    }
}
