<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Domain;
use App\Expertise;
use App\Reference;
use App\Subsidiary;

class DomainController extends Controller
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
        $domains = Domain::paginate(8);
        // $domains->setPath('index');
        $view = view('domains.index')->with('domains', $domains);
        return $view;
    }

    public function custom_index($id)
    {
        $subsidiary = Subsidiary::find($id);
        $domains = Domain::paginate(20);
        $linked_domains = $subsidiary->domains()->get();

        $view = view('domains.custom_index', ['domains'=>$domains, 'subsidiary'=>$subsidiary, 'linked_domains'=>$linked_domains]);
        return $view;   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $view = view('domains.create', ['subsidiary'=>$subsidiary]);
        return $view;
    }

    // public function link_domain($subsidiary_id, $domain_id)
    // {
    //     $subsidiary = Subsidiary::find($subsidiary_id);

    //     $subsidiary->domains()->attach($domain_id);

    //     $domain = Domain::find($domain_id);

    //     foreach ($domain->expertises as $expertise) {
    //         $subsidiary->expertises()->attach($expertise->id);
    //     }

    //     return redirect()->back();
    // }

    public function link_domain(Request $request, $subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->domains()->detach();
        // $subsidiary->expertises()->detach();

        if ($request->id) {
            foreach ($request->id as $domain_id) {
                $subsidiary->domains()->attach($domain_id);
                // $domain = Domain::find($domain_id);
                // foreach ($domain->expertises as $expertise) {
                //     $subsidiary->expertises()->attach($expertise->id);
                // }
            }
            $domains = Domain::all();

            foreach ($domains as $domain) {
                $found = 0;
                foreach ($subsidiary->domains as $value) {
                    if ($value->id == $domain->id) {
                        $found = 1;
                    }
                }
                if ($found == 0) {
                    foreach ($domain->expertises as $expertise) {
                        $subsidiary->expertises()->detach($expertise->id);
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function detach_domain($subsidiary_id, $domain_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->domains()->detach($domain_id);

        $domain = Domain::find($domain_id);

        foreach ($domain->expertises as $expertise) {
            $subsidiary->expertises()->detach($expertise->id);
        }      

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
            'name'     => 'required|string|max:255|unique:domains',
        ]);

        $new_domain = new Domain;
        $new_domain->name = $request->name;
        $new_domain->save();

        $new_domain->subsidiaries()->attach($request->subsidiary_id);

        return redirect()->action('DomainController@custom_edit', [$request->subsidiary_id, $new_domain->id]);
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

        $expertises = $domain->expertises()->paginate(10);

        $view = view('domains.edit', ['domain' => $domain, 'expertises' => $expertises]);
        return $view;
    }

    public function custom_edit($subsidiary_id, $domain_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $domain = Domain::find($domain_id);

        $expertises = $domain->expertises()->paginate(9);

        $linked_expertises = $subsidiary->expertises()->get();

        $parent_expertises = Expertise::whereNull('parent_expertise_id')->where('domain_id', $domain_id)->get();

        $view = view('domains.custom_edit', ['subsidiary'=>$subsidiary, 'domain' => $domain, 'expertises' => $expertises, 'linked_expertises'=>$linked_expertises, 'parent_expertises'=>$parent_expertises]);
        return $view;   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary_id, $id)
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

        return redirect()->action('DomainController@custom_index', $subsidiary_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subsidiary_id, $domain_id)
    {
        // dd($_POST);

        $domain = Domain::find($domain_id);

        foreach ($domain->expertises as $expertise) {
            if ($expertise->parent_expertise_id != NULL) {
                $expertise->parent_expertise_id = NULL;

                $expertise->save();
            }
        }

        foreach ($domain->expertises as $expertise) {
            // $references = Reference::whereHas('expertises', function ($query) use ($expertise) {
            //     $query->where('expertises.id', $expertise->id);
            // })->get();

            // if ($references) {
            //     foreach ($references as $reference) {
            //         $reference->expertises()->detach($expertise->id);
            //     }
            // }
            $expertise->references()->detach();
            $expertise->subsidiaries()->detach();

            Expertise::destroy($expertise->id);
        }

        $domain->subsidiaries()->detach();

        Domain::destroy($domain->id);

        return redirect()->action('DomainController@custom_index', $subsidiary_id);
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
