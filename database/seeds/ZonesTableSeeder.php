<?php

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$countries = App\Country::all();

        factory(App\Zone::class, 2)->create()->each(function($z) use($countries) {
        	$z->countries()->saveMany($countries->random(mt_rand(1, 5))->all());
        });
    }
}
