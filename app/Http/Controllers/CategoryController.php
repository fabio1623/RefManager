<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Measure;
use App\Reference;
use App\Qualifier;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(8);
        $categories->setPath('index');

        $view = view('categories.index')->with('categories', $categories);
        
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('categories.create');
        
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
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $new_category = new Category;
        $new_category->name = $request->name;
        
        $new_category->save();

        return redirect()->action('CategoryController@edit', $new_category);
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
        $category = Category::find($id);
        $measures = $category->measures()->paginate(4);

        $view = view('categories.edit', ['category'=>$category, 'measures'=>$measures]);
        
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
            'name'     => 'required|string|max:255|unique:categories,name,'.$id,
        ]);

        $category = Category::find($id);

        if ($category->name != $request->name) {
            $category->name = $request->name;

            $category->save();
        }

        return redirect()->action('CategoryController@index');
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
        
        $category = Category::find($request->category_id);

        //Delete all related measures
        foreach ($category->measures as $measure) {
            $references = Reference::whereHas('measures', function ($query) use ($measure) {
                $query->where('measures.id', $measure->id);
            })->get();

            if ($references) {
                foreach ($references as $reference) {
                    $reference->measures()->detach($measure->id);
                }
            }

            $qualifiers = Qualifier::whereHas('measures', function ($query) use ($measure) {
                $query->where('measures.id', $measure->id);
            })->get();

            if ($qualifiers) {
                foreach ($qualifiers as $qualifier) {
                    $qualifier->measures()->detach($measure->id);
                }
            }

            Measure::destroy($measure->id);
        }

        Category::destroy($category->id);

        return redirect()->action('CategoryController@index');
    }

    public function destroy_multiple(Request $request)
    {
        dd($_POST);
        $ids = $request->input('id');
        Category::destroy($ids);

        return redirect()->action('CategoryController@index');
    }
}
