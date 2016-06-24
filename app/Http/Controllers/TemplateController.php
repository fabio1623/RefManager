<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage;

use App\Template;
use App\Language;

use Auth;

class TemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // If user logged
        if(Auth::user())
        {
          $this->middleware('profile:'.Auth::user()->profile_id);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directory = storage_path('app/Exports');
        $language_folders = array();

        foreach (glob($directory.'/*', GLOB_ONLYDIR) as $folder_key=>$folder) {
            $folder_name = basename($folder);
            if ($folder_name != 'Other templates') {
                if(count(glob($directory.'/'.$folder_name.'/*')) != 0) {
                    $sub_folders_tab = array();
                    foreach (glob($directory.'/'.$folder_name.'/*') as $sub_folder_key=>$sub_folder) {
                        $sub_folder_name = basename($sub_folder);
                        array_push($sub_folders_tab, $sub_folder_name);
                    }
                    $language_folders[$folder_name] = $sub_folders_tab;
                }
            }
        }

        $languages = Language::orderBy('name', 'asc')->get();

        $view = view('references.import.template_upload', ['language_folders'=>$language_folders, 'languages'=>$languages]);
        return $view;
    }

    public function upload_template(Request $request)
    {
        // dd($_POST);
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $has_folder = Storage::disk('local')->has('Exports/'.$request->language);

        if ($has_folder == false) {
            Storage::makeDirectory('Exports/'.$request->language);
        }

        $destination_path = storage_path('app/Exports/'.$request->language);

        if ($request->hasFile('file')) {
            if ($file->isValid()) {
                $file->move($destination_path, 'Template.docx');
            }
            else {
                dd('File not valid');
            }
        }
        else {
            dd('No file');
        }

        return redirect()->back();
    }

    public function download_template($language)
    {
        return response()->download(storage_path('app/Exports/'.$language.'/Template.docx'));
    }

    public function delete_template($language)
    {
        // dd($language);
        Storage::delete('Exports/'.$language.'/Template.docx');

        return redirect()->back();
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
