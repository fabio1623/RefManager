<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Hash;

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
        $users = User::paginate(8);
        // $users->setPath('index');
        $view = view('auth.index')->with('users', $users);
        return $view;
    }

    public function search(Request $request)
    {
        /*dd($_POST);*/
        $users = User::where('username', 'LIKE', '%'.$request->input('search_inp').'%')
                        ->orWhere('profile', 'LIKE', '%'.$request->input('search_inp').'%')
                        ->paginate(8);
        // $users->setPath('search');
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
        // dd($_POST);
        $this->validate($request, [
            // 'first_name' => 'required|alpha|max:255',
            // 'last_name'  => 'required|alpha|max:255',
            'username'  =>  'required',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
            'profile'    => 'required',
        ]);
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password  = bcrypt($request->password);
        $user->profile = $request->profile;
        
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
            'username' => 'required|max:255',
            'email'     => 'required|email|max:255',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->profile = $request->profile;

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
        // dd($_POST);
        $ids = $request->input('id');
        User::destroy($ids);

        return redirect()->action('UserController@index');
    }

    // public function destroyOne(Request $request)
    // {
    //     // dd($_POST);
    //     $id = $request->input('hidden_field');
    //     User::destroy($id);

    //     return redirect()->action('UserController@index');
    // }

    public function destroyOne($id)
    {
        // dd($_POST);
        User::destroy($id);

        return redirect()->action('UserController@index');
    }

    public function authenticate(Request $request)
    {
        // dd($_POST);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended('home');
        }
        // $ddb_user = User::where('email', $request->input('email'))->first();
        //     if ($ddb_user) {
        //         Auth::login($ddb_user);
        //         return redirect()->intended('home');
        //     }
            // else {
            //     return redirect('auth/login');
            // }
    }

    public function getLoginError(Request $request)
    {
        $view = view('auth.loginError');
        return $view;
    }

    public function createByRequest(Request $request)
    {
        // dd($_POST);
        $view = view('auth.register_by_request')->with('email', $request->email);
        return $view;
    }

    public function manageAccount($id)
    {
        $user = User::find($id);

        $view = view('auth.account_management')->with('user', $user);

        return $view;
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required|max:255',
            'new_password'  => 'required|max:255|confirmed',
        ]);

        $user = User::find($id);

        if ( Hash::check($request->old_password, $user->password) ) {
            $user->password = Hash::make($request->new_password);

            $user->save();
        }
        else {
            dd('No');
        }

        
        $view = view('home');

        return $view;
    }
}
