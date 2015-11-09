<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expertise;
use App\Domain;

class ExpertiseController extends Controller
{
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
        $domain = Domain::find($request->input('domain_id_hidden'));

        $view = view('expertises.create')->with('domain', $domain);
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
        $dd_expertise = Expertise::find($request->input('name'));
        $domain = Domain::find($request->input('domain_id_hidden'));

        if ($dd_expertise) {
            $domain->expertises()->attach($expertise->id);
        }
        else {
            $expertise = new expertise;
            $expertise->name = $request->input('name');

            $expertise->save();    
            $domain->expertises()->attach($expertise->id);
        }

        return redirect()->action('DomainController@edit', $domain);
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
        $expertise = Expertise::find($expertise_id);
        $domain = Domain::find($domain_id);

        // $view = view('expertises.edit', ['expertise'=>$expertise, 'domain'=>$domain]);
        $view = view('expertises.edit', ['domain'=>$domain, 'expertise'=>$expertise]);
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
        $expertise = Expertise::find($expertise_id);
        $expertise->name = $request->input('name');

        $expertise->save();

        return redirect()->action('DomainController@edit', $domain_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $domain_id)
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
