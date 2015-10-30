<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use App\Domain;
use App\Expertise;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('references.index');
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $internal_services = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'external')
                                        ->first()
                                        ->subServices()->get();
        $external_services = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'internal')
                                        ->first()
                                        ->subServices()->get();

        $domains = Domain::all();

        $expertises = Expertise::all();

        /*dd($internal_services);*/
        $view = view('references.create', ['internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises]);
        return $view;
    }

    public function search()
    {
        $view = view('references.search');
        return $view;
    }

    public function results()
    {
        $view = view('references.results');
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
            'name' => 'required|unique:agencies|alpha|max:20',
            'address' => 'required|alpha_num|max:50',
        ]);
        $reference = new Reference;
        $reference->name = $request->input('name');
        $reference->address = $request->input('address');
        $reference->save();

        return redirect()->action('ReferenceController@index');
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
}
