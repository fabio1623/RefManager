<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Measure;
use App\Category;

class MeasureController extends Controller
{
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dd_measure = Measure::find($request->input('name'));
        $category = Category::find($request->input('category_id_hidden'));

        if ($dd_measure) {
            $category->measures()->attach($measure->id);
        }
        else {
            $measure = new Measure;
            $measure->name = $request->input('name');

            $measure->save();

            $category->measures()->attach($measure->id);
        }

        return redirect()->action('CategoryController@edit', $category);
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
        $this->validate($request, [
            'name' => 'required|alpha|max:255|unique:measures',
        ]);

        $measure = new Measure;
        $measure->name = $request->input('name');

        $user->save();

        return redirect()->action('CategoryController@edit', $measure_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $category_id)
    {
        dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $measure = Measure::where('id',$id)->first();
            $measure->categories()->detach();
        }

        Measure::destroy($ids);

        return redirect()->action('CategoryController@edit', $category_id);
    }
}
