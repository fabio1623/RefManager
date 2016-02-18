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

    // public function link_measure($subsidiary_id, $measure_id)
    // {
    //     $subsidiary = Subsidiary::find($subsidiary_id);

    //     $subsidiary->measures()->attach($measure_id);

    //     return redirect()->back();
    // }

    public function link_measure(Request $request, $subsidiary_id, $category_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $category = Category::find($category_id);
        $selected_measures_nb = 0;
        $category_found = 0;

        foreach ($category->measures as $measure) {
            $subsidiary->measures()->detach($measure->id);
        }

        if ($request->id) {
            foreach ($request->id as $measure_id) {
                $subsidiary->measures()->attach($measure_id);
                $selected_measures_nb++;
            }

            if ( $selected_measures_nb == $category->measures()->count() ) {
                foreach ($subsidiary->categories as $linked_category) {
                    if ($linked_category->id == $category_id) {
                        $category_found = 1;
                    }
                }
                if ($category_found == 0) {
                    $subsidiary->categories()->attach($category_id);
                }
            }
        }
        else {
            $subsidiary->categories()->detach($category_id);
        }

        return redirect()->back();
    }

    public function detach_measure($subsidiary_id, $category_id)
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
    public function store(Request $request, $subsidiary_id, $category_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'measure_name'     => 'required|string|max:255|unique:measures,name,NULL,id,category_id,'.$category_id,
            'field_type' => 'required'
        ]);

        $new_measure = new Measure;

        $new_measure->name = $request->measure_name;
        $new_measure->field_type = $request->field_type;
        $new_measure->category_id = $category_id;

        $new_measure->save();

        $subsidiary = Subsidiary::find($subsidiary_id);
        $subsidiary->measures()->attach($new_measure->id);

        return redirect()->action('CategoryController@custom_edit', [$subsidiary_id, $category_id]);
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
    public function edit($subsidiary_id, $category_id, $measure_id)
    {
        $measure = Measure::find($measure_id);
        $category = Category::find($category_id);

        $view = view('measures.edit', ['category'=>$category, 'measure'=>$measure, 'subsidiary_id'=>$subsidiary_id]);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary_id, $category_id, $measure_id)
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

        return redirect()->action('CategoryController@custom_edit', [$subsidiary_id, $category_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subsidiary_id, $category_id, $measure_id)
    {
        // dd($_POST);
        $measure = Measure::find($measure_id);

        // $references = Reference::whereHas('measures', function ($query) use ($measure_id) {
        //     $query->where('measures.id', $measure_id);
        // })->get();

        // if ($references) {
        //     foreach ($references as $reference) {
        //         $reference->measures()->detach($measure_id);
        //     }
        // }

        // $qualifiers = Qualifier::whereHas('measures', function ($query) use ($measure_id) {
        //     $query->where('measures.id', $measure_id);
        // })->get();

        // if ($qualifiers) {
        //     foreach ($qualifiers as $qualifier) {
        //         $qualifier->measures()->detach($measure_id);
        //     }
        // }

        $measure->references()->detach();
        $measure->qualifiers()->detach();
        $measure->subsidiaries()->detach();

        Measure::destroy($measure_id);

        return redirect()->action('CategoryController@custom_edit', [$subsidiary_id, $category_id]);
    }
}
