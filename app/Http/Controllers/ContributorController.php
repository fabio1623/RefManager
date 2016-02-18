<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contributor;
use App\Subsidiary;
use App\Zone;

class ContributorController extends Controller
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
    public function index($subsidiary_id, $zone_id)
    {
        $contributors = Contributor::paginate(8);
        $view = view('contributors.index', ['subsidiary_id'=>$subsidiary_id, 'contributors'=>$contributors]);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subsidiary_id, $zone_id)
    {
        // $subsidiary = Subsidiary::find($subsidiary_id);

        $view = view('contributors.create', ['subsidiary_id'=>$subsidiary_id, 'zone_id'=>$zone_id]);
        return $view;
    }

    public function custom_create($subsidiary_id)
    {
        $view = view('contributors.custom_create', ['subsidiary_id'=>$subsidiary_id]);
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $subsidiary_id, $zone_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:contributors',
        ]);

        $new_manager = new Contributor;
        $new_manager->name = $request->name;
        $new_manager->profile = 'In-house';

        $new_manager->save();

        $zone = Zone::find($zone_id);
        $zone->manager = $new_manager->id;

        $zone->save();

        return redirect()->action('ZoneController@edit', [$subsidiary_id, $zone_id]);
    }

    public function custom_store(Request $request, $subsidiary_id, $zone_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:contributors',
        ]);

        $new_manager = new Contributor;
        $new_manager->name = $request->name;
        $new_manager->profile = 'In-house';

        $new_manager->save();

        return redirect()->action('ContributorController@index', [$subsidiary_id, $zone_id]);
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
        //
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
        //
    }

    public function destroyMultiple(Request $request, $subsidiary_id, $zone_id)
    {
        // dd($_POST);

        foreach ($request->ids as $id) {
            $zones = Zone::where('manager', $id)->get();
            foreach ($zones as $zone) {
                $zone->manager = null;
                $zone->save();
            }
        }

        Contributor::destroy($id);

        return redirect()->action('ContributorController@index', [$subsidiary_id, $zone_id]);  
    }
}
