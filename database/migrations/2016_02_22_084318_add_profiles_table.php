<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Profile;

class AddProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $profiles_tab = ['Basic user', 'Reference administrator', 'Dcom manager', 'Subsidiary administrator', 'User administrator'];

            foreach ($profiles_tab as $profile) {
                $new_profile = new Profile;

                $new_profile->name = $profile;
                $new_profile->save();
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
        Schema::drop('profiles');
    }
}
