<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subsidiary;
use App\Language;

class LanguageController extends Controller
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
    public function index($subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        // $languages = Language::paginate(20);
        $languages = Language::orderBy('name', 'asc')->get();
        $linked_languages = $subsidiary->languages()->get();

        return view('languages.index', ['subsidiary'=>$subsidiary, 'languages'=>$languages, 'linked_languages'=>$linked_languages]);
    }

    public function search(Request $request, $subsidiary_id)
    {
        // dd($_GET);
        $subsidiary = Subsidiary::find($subsidiary_id);

        $languages = Language::where('name', 'like', '%'.$request->search_input.'%')->
                                orWhere('code', 'like', '%'.$request->search_input.'%')->paginate(20);
        $linked_languages = $subsidiary->languages()->get();


        return view('languages.index', ['subsidiary'=>$subsidiary, 'languages'=>$languages, 'linked_languages'=>$linked_languages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function link_languages(Request $request, $subsidiary_id)
    {
        // dd($_POST);
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->languages()->detach();

        if ($request->ids) {
            foreach ($request->ids as $value) {
                $subsidiary->languages()->attach($value);
            }
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
        //
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
