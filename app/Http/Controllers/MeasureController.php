<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Measure;
use App\Category;
use App\Reference;
use App\Qualifier;
use App\Subsidiary;

class MeasureController extends Controller
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
        $measures = Measure::paginate(4);
        $measures->setPath('index');

        $view = view('measures.index')->with('measures', $measures);
        
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
        $category = Category::find($request->input('category_id_hidden'));

        $view = view('measures.create')->with('category', $category);
        return $view;
    }

    public function link_measure($subsidiary_id, $measure_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->measures()->attach($measure_id);

        return redirect()->back();
    }

    public function detach_measure($subsidiary_id, $measure_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->measures()->detach($measure_id);        

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
            'name'     => 'required|string|max:255|unique:measures,name,NULL,id,category_id,'.$request->category_id,
            'field_type' => 'required'
        ]);

        $new_measure = new Measure;

        $new_measure->name = $request->name;
        $new_measure->field_type = $request->field_type;
        $new_measure->category_id = $request->category_id;

        $new_measure->save();


        return redirect()->action('CategoryController@edit', $request->category_id);
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
    public function edit($category_id, $measure_id)
    {
        $measure = Measure::find($measure_id);
        $category = Category::find($category_id);

        // $view = view('expertises.edit', ['expertise'=>$expertise, 'domain'=>$domain]);
        $view = view('measures.edit', ['category'=>$category, 'measure'=>$measure]);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id, $measure_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'name'     => 'required|string|max:255|unique:measures,name,'.$measure_id.',id,category_id,'.$category_id,
            'field_type' => 'required'
        ]);

        $measure = Measure::find($measure_id);
        $measure->name = $request->name;
        $measure->field_type = $request->field_type;

        $measure->save();

        return redirect()->action('CategoryController@edit', $category_id);
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
        $measure = Measure::find($request->measure_id);

        $references = Reference::whereHas('measures', function ($query) use ($request) {
            $query->where('measures.id', $request->measure_id);
        })->get();

        if ($references) {
            foreach ($references as $reference) {
                $reference->measures()->detach($request->measure_id);
            }
        }

        $qualifiers = Qualifier::whereHas('measures', function ($query) use ($request) {
            $query->where('measures.id', $request->measure_id);
        })->get();

        if ($qualifiers) {
            foreach ($qualifiers as $qualifier) {
                $qualifier->measures()->detach($request->measure_id);
            }
        }

        Measure::destroy($request->measure_id);

        return redirect()->action('CategoryController@edit', $request->category_id);
    }
}
