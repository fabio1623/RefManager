<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use App\Zone;

use Auth;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // If user logged
        if(Auth::user())
        {
          $this->middleware('profile:'.Auth::user()->profile_id);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $countries = Country::orderBy('continent')->orderBy('name')->paginate(100);

      $view = view('countries.index', ['countries'=>$countries]);
      return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $continents = Country::select('continent')
                      ->where('continent', '<>', '')
                      ->orderBy('continent')
                      ->distinct()->get();
      $zones = Zone::orderBy('name')->get();

      $view = view('countries.create', ['continents'=>$continents, 'zones'=>$zones]);
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
      $this->validate($request, [
          'name' => 'required|max:255|unique:countries,name',
      ]);

      $country = new Country;
      $country->name = trim($request->name);
      $country->continent = $request->continent;

      $country->save();

      if ($request->zones)
      {
        foreach ($request->zones as $z_id) {
          $country->zones()->attach($z_id);
        }
      }

      return redirect()->action('CountryController@index')->with('status', $country->name.' added!');
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
      $country = Country::find($id);
      $continents = Country::select('continent')
                      ->where('continent', '<>', '')
                      ->orderBy('continent')
                      ->distinct()->get();

      $view = view('countries.edit', ['country'=>$country, 'continents'=>$continents]);
      return $view;
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
      $this->validate($request, [
          'name' => 'required|max:255|unique:countries,name,'.$id,
      ]);

      $country = Country::find($id);
      $country->name = trim($request->name);
      $country->continent = $request->continent;
      $country->save();

      return redirect()->action('CountryController@edit', $id)->with('update', 'Changes saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $country = Country::find($id);
      $country_name = $country->name;
      $country->zones()->detach();
      Country::destroy($id);

      return redirect()->action('CountryController@index')->with('status', $country_name.' removed!');
    }

    public function destroy_country($id)
    {
      $country = Country::find($id);
      $country->zones()->detach();
      Country::destroy($id);
    }

    public function destroy_unsigned()
    {
      $unsigned_countries = Country::has('references', '<', 1)->orWhere('name', '')->get();

      if (count($unsigned_countries) > 0) {
        foreach ($unsigned_countries as $c) {
          CountryController::destroy_country($c->id);
        }
        return redirect()->action('ReferenceController@management_page')->with('status', 'Unsigned countries removed!');
      }
      else {
        return redirect()->action('ReferenceController@management_page')->with('caution', 'Nothing to remove..');
      }
    }
}
