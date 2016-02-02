<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;

use App\ExternalService;
use App\InternalService;
use App\Subsidiary;
use Auth;

class ServiceController extends Controller
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


//-------- External services --------//


    public function index()
    {
        $external_services = ExternalService::paginate(8);

        $view = view('services.external.index')->with('external_services', $external_services);
        return $view;
    }

    public function subsidiary_external_services()
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        // $external_services = $subsidiary->external_services()->paginate(8);
        $external_services = ExternalService::paginate(14);
        $linked_services = $subsidiary->external_services()->get();
        // dd($linked_services);

        $view = view('services.external.subsidiary_index', ['external_services'=>$external_services, 'linked_services'=>$linked_services, 'subsidiary'=>$subsidiary]);
        return $view;   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $view = view('services.external.create');
        return $view;
    }

    public function link_external_service($id)
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $external_service = ExternalService::find($id);

        $subsidiary->external_services()->attach($external_service->id);

        return redirect()->back();
    }

    public function detach_external_service($id)
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $external_service = ExternalService::find($id);

        $subsidiary->external_services()->detach($external_service->id);

        return redirect()->back();   
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

        //Validate the input value
        $this->validate($request, [
            'name' => 'required|unique:external_services',
        ]);

        //Create new service
        $new_external_service = new ExternalService;
        $new_external_service->name = $request->name;

        $new_external_service->save();

        //Attach the service to the current user subsidiary
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);

        $subsidiary->external_services()->attach($new_external_service->id);

        return redirect()->action('ServiceController@index');
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
        // $subsidiary = Subsidiary::find($subsidiary_id);
        $external_service = ExternalService::find($id);

        $view = view('services.external.edit', ['external_service'=>$external_service]);
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
        // dd($_POST);
        $external_service = ExternalService::find($id);
        $external_service->name = $request->name;

        $external_service->save();

        return redirect()->action('ServiceController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        // dd($_POST);
        // $subsidiary = Subsidiary::find($request->subsidiary_id);
        // $subsidiary->external_services()->detach($id);
        $external_service = ExternalService::find($id);
        $external_service->references()->detach();
        ExternalService::destroy($id);

        return redirect()->action('ServiceController@index');   
    }

    public function destroy_multiple(Request $request)
    {
        // dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $external_service = ExternalService::find($id);
            $external_service->references()->detach();
        }

        ExternalService::destroy($ids);

        return redirect()->action('ServiceController@index');
    }


//-------- Internal services --------//


    public function internal_index()
    {
        $internal_services = InternalService::paginate(8);
        // dd($external_services);

        $view = view('services.internal.index')->with('internal_services', $internal_services);
        return $view;
    }

    public function subsidiary_internal_services()
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);

        $internal_services = InternalService::paginate(14);
        $linked_services = $subsidiary->internal_services()->get();
        // dd($linked_services);

        $view = view('services.internal.subsidiary_index', ['internal_services'=>$internal_services, 'linked_services'=>$linked_services, 'subsidiary'=>$subsidiary]);
        return $view;
    }

    public function internal_create()
    {
        $view = view('services.internal.create');
        return $view;
    }

    public function link_internal_service($id)
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $internal_service = InternalService::find($id);

        $subsidiary->internal_services()->attach($internal_service->id);

        return redirect()->back();
    }

    public function detach_internal_service($id)
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $internal_service = InternalService::find($id);

        $subsidiary->internal_services()->detach($internal_service->id);

        return redirect()->back();   
    }

    public function internal_store(Request $request)
    {
        // dd($_POST);

        //Validate the input value
        $this->validate($request, [
            'name' => 'required|unique:internal_services',
        ]);

        //Create new service
        $internal_service = new InternalService;
        $internal_service->name = $request->name;

        $internal_service->save();

        return redirect()->action('ServiceController@internal_index');
    }

    public function internal_edit($id)
    {
        $internal_service = InternalService::find($id);

        $view = view('services.internal.edit')->with('internal_service', $internal_service);
        return $view;
    }

    public function internal_update(Request $request, $id)
    {
        // dd($_POST);
        $internal_service = InternalService::find($id);
        $internal_service->name = $request->name;

        $internal_service->save();

        return redirect()->action('ServiceController@internal_index');
    }

    public function internal_destroy($id)
    {
        // dd($id);
        $internal_service = InternalService::find($id);
        $internal_service->references()->detach();
        InternalService::destroy($id);

        return redirect()->action('ServiceController@internal_index');   
    }

    public function internal_destroy_multiple(Request $request)
    {
        // dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $internal_service = InternalService::find($id);
            $internal_service->references()->detach();
        }

        InternalService::destroy($ids);

        return redirect()->action('ServiceController@internal_index');
    }
}
