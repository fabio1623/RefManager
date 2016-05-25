<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contact', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_contact');
    }
}
