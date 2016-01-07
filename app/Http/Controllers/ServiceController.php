<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;

use App\ExternalService;
use App\InternalService;

class ServiceController extends Controller
{
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
        $external_service = new ExternalService;
        $external_service->name = $request->name;

        $external_service->save();

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
        $external_service = ExternalService::find($id);

        $view = view('services.external.edit')->with('external_service', $external_service);
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

    public function destroy($id)
    {
        // dd($id);
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

    public function internal_create()
    {
        $view = view('services.internal.create');
        return $view;
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
