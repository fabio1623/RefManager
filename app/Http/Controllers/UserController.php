<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
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
        $users = User::paginate(4);
        $users->setPath('index');
        $view = view('auth.index')->with('users', $users);
        return $view;
    }

    public function search(Request $request)
    {
        /*dd($_POST);*/
        $users = User::where('first_name', 'LIKE', '%'.$request->input('search_inp').'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->input('search_inp').'%')
                        ->orWhere('profile', 'LIKE', '%'.$request->input('search_inp').'%')
                        ->paginate(4);
        $users->setPath('search');
        $view = view('auth.index')->with('users', $users);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('auth.register');
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
            'first_name' => 'required|alpha|max:255',
            'last_name'  => 'required|alpha|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
            'profile'    => 'required',
        ]);
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password  = bcrypt($request->input('password'));
        $user->profile = $request->input('profile');
        $user->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $view = view('auth.show')->with('user', $user);
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $view = view('auth.edit')->with('user', $user);
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
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'     => 'required|email|max:255',
        ]);

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->profile = $request->input('profile');
        $user->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($_POST);
        $ids = $request->input('id');
        User::destroy($ids);

        return redirect()->action('UserController@index');
    }

    public function destroyOne(Request $request)
    {
        dd($_POST);
        $id = $request->input('hidden_field');
        User::destroy($id);

        return redirect()->action('UserController@index');
    }

    /*public function throwError() {
        $view = view('auth.loginError');
        return $view;
    }*/
}
