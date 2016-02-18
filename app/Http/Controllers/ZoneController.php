<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zone;
use App\Country;
use App\Contributor;
use App\Subsidiary;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);
        $zones = Zone::paginate(20);

        $view = view('zones.index', ['subsidiary'=>$subsidiary, 'zones'=>$zones]);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subsidiary_id)
    {
        $contributors = Contributor::where('profile', 'In-house')->get();

        $view = view('zones.create', ['subsidiary_id'=>$subsidiary_id, 'contributors'=>$contributors]);
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $subsidiary_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'name' => 'required|alpha|max:255|unique:zones',
        ]);

        $zone = new Zone;
        $zone->name = $request->name;

        if ($request->manager != '') {
            $zone->manager = $request->manager;
        }
    
        $zone->save();

        return redirect()->action('ZoneController@index', $subsidiary_id);
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
    public function edit($subsidiary_id, $zone_id)
    {
        $zone = Zone::find($zone_id);
        $zone_countries = $zone->countries()->get();

        // $id_tab = [];

        // foreach ($zone->countries as $country) {
        //     $id_tab[] = $country->id;
        // }

        // $countries = Country::whereNotIn('id', $id_tab)->get();
        $countries = Country::orderBy('name', 'asc')->get();

        // $contributors = Contributor::whereHas('references', function ($query) {
        //     $query->where('function_on_project', 'Senior');
        // })->get();

        $contributors = Contributor::where('profile', 'In-house')->get();

        $view = view('zones.edit', ['subsidiary_id'=>$subsidiary_id, 'zone'=>$zone, 'countries'=>$countries, 'zone_countries'=>$zone_countries, 'contributors'=>$contributors]);
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

    public function detach_country($zone_id, $country_id)
    {
        // dd($_POST);
        $zone = Zone::find($zone_id);

        $zone->countries()->detach($country_id);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary_id, $zone_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'name' => 'required|alpha|max:255|unique:zones,name,'.$zone_id,
        ]);

        $zone = Zone::find($zone_id);

        $zone->name = $request->name;

        if ($request->manager != '') {
            $zone->manager = $request->manager;
        }
        else {
            $zone->manager = null;
        }

        $zone->countries()->detach();
        if ($request->countries) {
            foreach ($request->countries as $country_id) {
                $zone->countries()->attach($country_id);
            }
        }

        $zone->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subsidiary_id, $zone_id)
    {
        // dd($_POST);

        $zone = Zone::find($zone_id);
        $zone->countries()->detach();

        Zone::destroy($zone_id);

        return redirect()->action('ZoneController@index', $subsidiary_id);
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
