<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expertise;
use App\Domain;
use App\Reference;
use App\Subsidiary;

class ExpertiseController extends Controller
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
    public function index()
    {
        $expertises = Expertise::paginate(2);
        // $domains->setPath('index');
        $view = view('expertises.index')->with('expertises', $expertises);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($_POST);
        $domain = Domain::find($request->domain_id);
        $parent_expertises = Expertise::whereNull('parent_expertise_id')
                                            ->where('domain_id', $domain->id)->get();

        $view = view('expertises.create', ['domain'=>$domain, 'parent_expertises'=>$parent_expertises]);
        return $view;
    }

    public function link_expertise($subsidiary_id, $expertise_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->expertises()->attach($expertise_id);

        return redirect()->back();
    }

    public function detach_expertise($subsidiary_id, $expertise_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->expertises()->detach($expertise_id);        

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
        $this->validate($request, [
            'name'     => 'required|string|max:255|unique:expertises,name,NULL,id,domain_id,'.$request->domain_id,
        ]);

        $new_expertise = new Expertise;
        $new_expertise->name = $request->name;
        $new_expertise->domain_id = $request->domain_id;

        if ($request->parent_expertise != '') {
            $new_expertise->parent_expertise_id = $request->parent_expertise;
        }

        $new_expertise->save();

        // $expertise_in_db = Expertise::where('name', $request->name)->first();
        // $domain = Domain::find($request->domain_id);

        // if ($expertise_in_db) {
        //     // dd('Present');
        //     $expertise_in_db->domain_id = $domain->id;

        //     $expertise_in_db->save();
        //     // $domain->expertises()->attach($expertise_in_db->id);
        // }
        // else {
        //     dd('Non present');
        //     $expertise = new expertise;
        //     $expertise->name = $request->input('name');

        //     $expertise->save();    
        //     $domain->expertises()->attach($expertise->id);
        // }

        return redirect()->action('DomainController@edit', $request->domain_id);
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
    public function edit($domain_id, $expertise_id)
    {
        // dd($_POST);
        $expertise = Expertise::find($expertise_id);
        $domain = Domain::find($domain_id);

        $parent_expertises = Expertise::where('id', '<>', $expertise_id)
                                            ->whereNull('parent_expertise_id')
                                            ->where('domain_id', $domain->id)->get();

        // $view = view('expertises.edit', ['expertise'=>$expertise, 'domain'=>$domain]);
        $view = view('expertises.edit', ['domain'=>$domain, 'expertise'=>$expertise, 'parent_expertises'=>$parent_expertises]);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $domain_id, $expertise_id)
    {
        // dd($_POST);
        $expertise = Expertise::find($expertise_id);
        $expertise->name = $request->input('name');

        if ($request->parent_expertise != '') {
            $expertise->parent_expertise_id = $request->parent_expertise;
        }

        $expertise->save();

        return redirect()->action('DomainController@edit', $domain_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $references = Reference::whereHas('expertises', function ($query) use ($request) {
            $query->where('domain_id', $request->domain_id);
        })->get();

        foreach ($references as $reference) {
            $reference->expertises()->detach($request->expertise_id);
        }

        Expertise::destroy($request->expertise_id);

        return redirect()->action('DomainController@edit', $request->domain_id);

    }

    public function destroyOne(Request $request, $domain_id)
    {
        dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $expertise = Expertise::where('id',$id)->first();
            $expertise->domains()->detach();
        }

        Expertise::destroy($ids);

        return redirect()->action('DomainController@edit', $domain_id);
    }
}
