<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reference;
use App\Service;
use App\Domain;
use App\Expertise;
use App\Category;
use App\Country;
use App\Location;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $references = Reference::paginate();
        $view = view('references.index')->with('references', $references);
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
                                        ->where('service_type', 'internal')
                                        ->first()
                                        ->subServices()->get();
        $external_services = Service::where('subsidiary','Seureca')
                                        ->where('service_type', 'external')
                                        ->first()
                                        ->subServices()->get();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        // $countries = Country::all();
        $locations = Location::all();

        /*dd($internal_services);*/
        $view = view('references.create', ['internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'locations'=>$locations]);
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
        // dd($_POST);
        $this->validate($request, [
            'project_number' => 'required|unique:references',
        ]);

        $reference = new Reference;

        $reference->project_number = $request->input('project_number');

        if ($request->input('confidential')) {
            $reference->confidential = 1;
        }

        $reference->dfac_name = $request->input('dfac_name');

        if ($request->input('start_date')) {
            $reference->start_date = $request->input('start_date');
        }

        if ($request->input('end_date')) {
            $reference->end_date = $request->input('end_date');
        }

        $reference->estimated_duration = $request->input('estimated_duration');
        $reference->project_name = $request->input('project_name');
        $reference->project_name_fr = $request->input('project_name_fr');
        $reference->project_name_es = $request->input('project_name_es');
        $reference->project_name_pt = $request->input('project_name_pt');
        $reference->service_name = $request->input('service_name');
        $reference->service_name_fr = $request->input('service_name_fr');
        $reference->service_name_es = $request->input('service_name_es');
        $reference->service_name_pt = $request->input('service_name_pt');
        $reference->project_description = $request->input('project_description');
        $reference->project_description_fr = $request->input('project_description_fr');
        $reference->project_description_es = $request->input('project_description_es');
        $reference->project_description_pt = $request->input('project_description_pt');
        $reference->service_description = $request->input('service_description');
        $reference->service_description_fr = $request->input('service_description_fr');
        $reference->service_description_es = $request->input('service_description_es');
        $reference->service_description_pt = $request->input('service_description_pt');
        
        if ($request->input('staff_number')) {
            $reference->staff_number = $request->input('staff_number');
        }

        if ($request->input('seureca_man_months')) {
            $reference->seureca_man_months = $request->input('seureca_man_months');
        }

        if ($request->input('consultants_man_months')) {
            $reference->consultants_man_months = $request->input('consultants_man_months');
        }
        $reference->total_project_cost = $request->input('total_project_cost');
        $reference->seureca_services_cost = $request->input('seureca_services_cost');
        $reference->work_cost = $request->input('work_cost');
        $reference->service_description = $request->input('service_description');
        $reference->general_comments = $request->input('general_comments');

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
        $reference = Reference::find($id);

        // $expertises = $domain->expertises()->paginate(1);

        $view = view('references.edit', ['reference' => $reference, 'expertises' => $expertises]);
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
