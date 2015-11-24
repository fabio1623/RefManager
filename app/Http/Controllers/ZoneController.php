<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zone;
use App\Country;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::paginate(8);
        $view = view('zones.index')->with('zones', $zones);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('zones.create');
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($_POST);
        $this->validate($request, [
            'name' => 'required|alpha|max:255|unique:zones',
        ]);
        $zone = new Zone;
        $zone->name = $request->input('name');
    
        $zone->save();

        return redirect()->action('ZoneController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::find($id);
        $countries = Country::all();
        
        $zone_countries = $zone->countries()->paginate(8);

        $view = view('zones.edit', ['zone'=>$zone, 'countries'=>$countries, 'zone_countries'=>$zone_countries]);
        return $view;
    }

    public function attach_country(Request $request, $zone_id)
    {
        // dd($_POST);
        $zone = Zone::find($zone_id);

        $country = Country::where('name', $request->input('involved_country'))
                                ->first();
        $exist = 0;

        foreach ($zone->countries as $country_in_zone) {
            if ($country_in_zone->id == $country->id) {
                $exist = 1;
            }
        }
        if ($exist == 0) {
            $zone->countries()->attach($country->id);
        }

        return redirect()->action('ZoneController@edit', $zone_id);
    }

    public function detach_country(Request $request, $zone_id)
    {
        // dd($_POST);
        $zone = Zone::find($zone_id);

        $zone->countries()->detach($request->input('country_id'));

        return redirect()->action('ZoneController@edit', $zone_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($_POST);

        $zone = Zone::find($id);
        $zone->countries()->detach();

        Zone::destroy($id);

        return redirect()->action('ZoneController@index');
    }

    public function destroyMultiple(Request $request)
    {
        // dd($_POST);

        $ids = $request->input('id');

        foreach ($ids as $id) {
            $zone = Zone::find($id);
            $zone->countries()->detach();
        }

        Zone::destroy($ids);

        return redirect()->action('ZoneController@index');  
    }
}
