<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Funding;

class FundingController extends Controller
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
        $fundings = Funding::orderBy('name', 'asc')->paginate(100);
        $view = view('fundings.index')->with('fundings', $fundings);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fundings.create');
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
            'english_name' => 'required|max:255|unique:fundings,name',
            'french_name' => 'required|max:255|unique:fundings,name_fr',
        ]);

        $new_funding = new Funding;
        $new_funding->name = $request->english_name;
        $new_funding->name_fr = $request->french_name;

        $new_funding->save();

        return redirect()->action('FundingController@index');
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
        $funding = Funding::find($id);
        $references = $funding->references()->get();

        return view('fundings.edit', ['funding'=>$funding, 'references'=>$references]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $funding_id)
    {
        $this->validate($request, [
            'english_name' => 'required|max:255|unique:fundings,name,'.$funding_id,
            'french_name' => 'required|max:255|unique:fundings,name_fr,'.$funding_id,
        ]);

        $funding = Funding::find($funding_id);
        $funding->name = $request->english_name;
        $funding->name_fr = $request->french_name;

        $funding->save();

        return redirect()->action('FundingController@edit', $funding_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($funding_id)
    {
        $funding = Funding::find($funding_id);
        $funding->references()->detach();

        Funding::destroy($funding_id);

        return redirect()->action('FundingController@index');
    }

    public function destroy_funding($id)
    {
      $funding = Funding::find($id);
      $funding->references()->detach();

      Funding::destroy($id);
    }

    public function destroy_unsigned()
    {
      $unsigned_fund = Funding::has('references', '<', 1)->orWhere('name', '')->get();

      if (count($unsigned_fund) > 0) {
        foreach ($unsigned_fund as $fund) {
          FundingController::destroy_funding($fund->id);
        }
        return redirect()->action('ReferenceController@management_page')->with('status', 'Unsigned fundings removed!');
      }
      else {
        return redirect()->action('ReferenceController@management_page')->with('caution', 'Nothing to remove..');
      }
    }

    // public function destroyMultiple(Request $request)
    // {
    //     // dd($_POST);

    //     // $ids = $request->input('id');

    //     // foreach ($ids as $id) {
    //     //     $zone = Zone::find($id);
    //     //     $zone->countries()->detach();
    //     // }

    //     // Zone::destroy($ids);

    //     return redirect()->action('ZoneController@index');
    // }
}
