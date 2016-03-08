<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subsidiary;
use App\User;
use App\Profile;

class SubsidiaryController extends Controller
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
        $subsidiaries = Subsidiary::paginate(4);
        // $subsidiaries->setPath('index');
        $view = view('subsidiaries.index')->with('subsidiaries', $subsidiaries);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('subsidiaries.create');
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
        /*dd($_POST);*/
        $this->validate($request, [
            'name' => 'required|max:50|unique:subsidiaries',
        ]);

        $subsidiary = new Subsidiary;
        $subsidiary->name = $request->input('name');
        
        $subsidiary->save();

        return redirect()->action('SubsidiaryController@index');
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
        $subsidiary = Subsidiary::find($id);
        // $users = $subsidiary->users()->get();
        $users = $subsidiary->users()->paginate(20);
        $profiles = Profile::all();
        
        $view = view('subsidiaries.edit', ['subsidiary'=>$subsidiary, 'users'=>$users, 'profiles'=>$profiles]);
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
        $this->validate($request, [
            'name' => 'required|max:50|unique:subsidiaries,name,'.$id,
        ]);

        $subsidiary = Subsidiary::find($id);
        $subsidiary->name = $request->input('name');

        $subsidiary->save();

        return redirect()->action('SubsidiaryController@edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($_POST);

        $subsidiary = Subsidiary::find($id);
        
        if ($subsidiary->users()->count() > 0) {
            $subsidiary->users()->detach();
        }

        Subsidiary::destroy($id);

        return redirect()->action('SubsidiaryController@index');
    }

    public function destroyMulti(Request $request)
    {
        // dd($_POST);

        $ids = $request->input('id');

        foreach ($$ids as $id) {
            $subsidiary = Subsidiary::find($id);
            $subsidiary->users()->detach();
        }

        Subsidiary::destroy($ids);

        return redirect()->action('SubsidiaryController@index');
    }
}
