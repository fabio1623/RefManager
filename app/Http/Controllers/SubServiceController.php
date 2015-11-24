<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use App\SubService;

class SubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_services = Service::where('subsidiary', 'Seureca')
                                    ->where('service_type', 'external')
                                    ->first()->subServices()
                                        ->paginate(8);
        $view = view('services.external.index')->with('services', $sub_services);
        return $view;
    }

    public function veoliaIndex()
    {
        $sub_services = Service::where('subsidiary', 'Seureca')
                                    ->where('service_type', 'internal')
                                    ->first()->subServices()
                                        ->paginate(8);
        $view = view('services.internal.index')->with('services', $sub_services);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function internalCreate()
    {
        $view = view('services.internal.create');
        return $view;
    }    

    public function store(Request $request) 
    {
        // dd($_POST);

        //Validate the input value
        $this->validate($request, [
            'service_name' => 'required|unique:sub_services',
        ]);

        //Create new sub service
        $sub_service = new subservice;
        $sub_service->service_name = $request->input('service_name');

        $sub_service->save();

        //Attach the sub service to the service group
        $service = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'external')
                                        ->first();
        $service->subServices()->attach($sub_service->id);

        return redirect()->action('SubServiceController@index');
    }

    public function search(Request $request) 
    {
        $subservices = Service::where('subsidiary', 'Seureca')
                                ->where('service_type', 'external')
                                ->first()->subServices()
                                    ->where('service_name', 'LIKE', '%'.$request->input('search_inp').'%')
                                    ->paginate(8);
        $subservices->setPath('/services');
        $view = view('services.index')->with('services', $subservices);
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExternal(Request $request)
    {
        // dd($_POST);

        //Validate the input value
        $this->validate($request, [
            'service-name' => 'required|unique:sub_services',
        ]);

        //Create new sub service
        $sub_service = new subservice;
        $sub_service->service_name = $request->input('service-name');

        $sub_service->save();

        //Attach the sub service to the service group
        $service = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'external')
                                        ->first();
        $service->subServices()->attach($sub_service->id);

        return redirect()->action('ReferenceController@create');
    }

    public function storeInternal(Request $request)
    {
        /*dd($_POST);*/

        //Validate the input value
        $this->validate($request, [
            'service_name' => 'required|unique:sub_services',
        ]);

        //Create new sub service
        $sub_service = new subservice;
        $sub_service->service_name = $request->input('service_name');

        $sub_service->save();

        //Attach the sub service to the service group
        $service = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'internal')
                                        ->first();
        $service->subServices()->attach($sub_service->id);

        return redirect()->action('SubServiceController@index');
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
        $service = SubService::find($id);

        $view = view('services.edit')->with('service', $service);
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
        $service = SubService::find($id);
        $service->service_name = $request->input('name');

        $service->save();

        return redirect()->action('SubServiceController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $sub_service = SubService::where('id',$id)->first();
            $sub_service->services()->detach();
        }

        SubService::destroy($ids);

        return redirect()->action('SubServiceController@index');
    }

    public function destroyOne(Request $request)
    {
        // dd($_POST);
        $id = $request->input('hidden_field');
        SubService::destroy($id);

        return redirect()->action('SubServiceController@index');
    }
}
