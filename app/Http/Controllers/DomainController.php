<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Domain;
use App\Expertise;
use App\Reference;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Domain::paginate(8);
        // $domains->setPath('index');
        $view = view('domains.index')->with('domains', $domains);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('domains.create');
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
            'name'     => 'required|string|max:255|unique:domains',
        ]);

        $domain = new Domain;
        $domain->name = $request->name;
        $domain->save();

        return redirect()->action('DomainController@index');
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
        $domain = Domain::find($id);

        $expertises = $domain->expertises()->paginate(4);

        $view = view('domains.edit', ['domain' => $domain, 'expertises' => $expertises]);
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
        $this->validate($request, [
            'name'     => 'required|string|max:255|unique:domains,name,'.$id,
        ]);

        $domain = Domain::find($id);

        if ($domain->name != $request->name) {
            $domain->name = $request->name;

            $domain->save();
        }

        return redirect()->action('DomainController@index');
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

        $domain = Domain::find($request->domain_id);

        foreach ($domain->expertises as $expertise) {
            if ($expertise->parent_expertise_id != NULL) {
                $expertise->parent_expertise_id = NULL;

                $expertise->save();
            }
        }

        foreach ($domain->expertises as $expertise) {
            $references = Reference::whereHas('expertises', function ($query) use ($expertise) {
                $query->where('expertises.id', $expertise->id);
            })->get();

            if ($references) {
                foreach ($references as $reference) {
                    $reference->expertises()->detach($expertise->id);
                }
            }

            Expertise::destroy($expertise->id);
        }

        Domain::destroy($domain->id);

        return redirect()->action('DomainController@index');
    }

    public function destroyOne(Request $request)
    {
        // dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $domain = Domain::where('id',$id)->first();
            $domain->expertises()->detach();
        }

        Domain::destroy($ids);

        return redirect()->action('DomainController@index');
    }
}
