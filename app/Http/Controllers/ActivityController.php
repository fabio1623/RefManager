<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Activity;

class ActivityController extends Controller
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
      $activities = Activity::orderBy('name')->get();

      $view = view('activities.index', ['activities'=>$activities]);
      return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('activities.create');
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
          'name' => 'required|alpha|max:255|unique:activities',
      ]);

      $activity = new Activity;
      $activity->name = trim($request->name);
      $activity->save();

      return redirect()->action('ActivityController@index')->with('status', 'Activity "'.$activity->name.'" created!');
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
      $activity = Activity::find($id);

      $view = view('activities.edit', ['activity'=>$activity]);
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
          'name' => 'required|alpha|max:255|unique:activities,name,'.$id,
      ]);

      $activity = Activity::find($id);
      $activity_name = $activity->name;
      $activity->name = trim($request->name);
      $activity->save();

      return redirect()->action('ActivityController@index')->with('status', 'Activity "'.$activity_name.'" updated to "'.$activity->name.'"!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity_name = $activity->name;

        Activity::destroy($id);

        return redirect()->action('ActivityController@index')->with('status', 'Activity "'.$activity_name.'" deleted!');
    }
}
