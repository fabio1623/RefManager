<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Measure;
use App\Reference;
use App\Qualifier;
use App\Subsidiary;

class CategoryController extends Controller
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
        $categories = Category::paginate(8);
        $categories->setPath('index');

        $view = view('categories.index')->with('categories', $categories);
        
        return $view;
    }

    public function custom_index($subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);
        $categories = Category::paginate(9);
        $linked_categories = $subsidiary->categories()->get();

        $view = view('categories.custom_index', ['categories'=>$categories, 'subsidiary'=>$subsidiary, 'linked_categories'=>$linked_categories]);
        return $view;   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subsidiary_id)
    {
        $view = view('categories.create', ['subsidiary_id'=>$subsidiary_id]);
        
        return $view;
    }

    // public function link_category($subsidiary_id, $category_id)
    // {
    //     $subsidiary = Subsidiary::find($subsidiary_id);

    //     $subsidiary->categories()->attach($category_id);

    //     $category = Category::find($category_id);

    //     foreach ($category->measures as $measure) {
    //         $subsidiary->measures()->attach($measure->id);
    //     }

    //     return redirect()->back();
    // }

    public function link_category(Request $request, $subsidiary_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $categories = Category::all();

        //If at least 1 category is selected
        if ($request->id) {
            foreach ($categories as $category_in_db) {
                $category_found = 0;
                foreach ($request->id as $category_id) {
                    if ($category_id == $category_in_db->id) {
                        $category_found = 1;
                    }
                }
                //Remove the link between the subsidiary and categories not selected
                if ($category_found == 0) {
                    $subsidiary->categories()->detach($category_in_db->id);
                    foreach ($category_in_db->measures as $measure_in_db) {
                        $subsidiary->measures()->detach($measure_in_db->id);
                    }
                }
                else {
                    $found = 0;
                    foreach ($subsidiary->categories as $linked_category) {
                        if ($linked_category->id == $category_in_db->id) {
                            $found = 1;
                        }
                    } 
                    if ($found == 0) {
                        $subsidiary->categories()->attach($category_in_db->id);
                        foreach ($category_in_db->measures as $measure_in_db) {
                            $subsidiary->measures()->attach($measure_in_db->id);
                        }
                    }   
                }
            }
        }
        //If no categories selected
        else {
            $subsidiary->categories()->detach();
            $subsidiary->measures()->detach();
        }

        return redirect()->back();
    }

    public function detach_category($subsidiary_id, $category_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $subsidiary->categories()->detach($category_id);  

        $category = Category::find($category_id);

        foreach ($category->measures as $measure) {
                 $subsidiary->measures()->detach($measure->id);
             }     

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $subsidiary_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $new_category = new Category;
        $new_category->name = $request->name;
        
        $new_category->save();

        $subsidiary = Subsidiary::find($subsidiary_id);
        $subsidiary->categories()->attach($new_category);

        return redirect()->action('CategoryController@custom_edit', [$subsidiary_id, $new_category->id]);
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
        $measures = $category->measures()->orderBy('name', 'asc')->get();

        $view = view('categories.edit', ['category'=>$category, 'measures'=>$measures]);
        
        return $view;
    }

    public function custom_edit($subsidiary_id, $category_id)
    {
        $subsidiary = Subsidiary::find($subsidiary_id);

        $category = Category::find($category_id);

        // $measures = $category->measures()->paginate(9);
        $measures = $category->measures()->get();

        $linked_measures = $subsidiary->measures()->get();

        $view = view('categories.custom_edit', ['subsidiary'=>$subsidiary, 'category'=>$category, 'measures'=>$measures, 'linked_measures'=>$linked_measures]);
        return $view;   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary_id, $category_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'name'     => 'required|string|max:255|unique:categories,name,'.$category_id,
        ]);

        $category = Category::find($category_id);

        if ($category->name != $request->name) {
            $category->name = $request->name;

            $category->save();
        }

        return redirect()->action('CategoryController@custom_index', $subsidiary_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $subsidiary_id, $category_id)
    {
        // dd($_POST);
        
        $category = Category::find($category_id);

        //Delete all related measures
        foreach ($category->measures as $measure) {
            // $references = Reference::whereHas('measures', function ($query) use ($measure) {
            //     $query->where('measures.id', $measure->id);
            // })->get();

            // if ($references) {
            //     foreach ($references as $reference) {
            //         $reference->measures()->detach($measure->id);
            //     }
            // }

            // $qualifiers = Qualifier::whereHas('measures', function ($query) use ($measure) {
            //     $query->where('measures.id', $measure->id);
            // })->get();

            // if ($qualifiers) {
            //     foreach ($qualifiers as $qualifier) {
            //         $qualifier->measures()->detach($measure->id);
            //     }
            // }

            $measure->references()->detach();
            $measure->qualifiers()->detach();
            $measure->subsidiaries()->detach();

            Measure::destroy($measure->id);
        }

        $category->subsidiaries()->detach();

        Category::destroy($category->id);

        return redirect()->action('CategoryController@custom_index', $subsidiary_id);
    }

    public function destroy_multiple(Request $request)
    {
        dd($_POST);
        $ids = $request->input('id');
        Category::destroy($ids);

        return redirect()->action('CategoryController@index');
    }
}
