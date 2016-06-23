<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\AccessRequest;
use Auth;
use Hash;
use App\Subsidiary;
use App\Profile;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'authenticate',
            'getLoginError',
            'getLoginWrongPassword',
            'retrieve_password',
            'change_password_page',
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);

        // $users = User::paginate(8);
        $users = $subsidiary->users()->paginate(100);
        // $users->setPath('index');
        $view = view('auth.index')->with('users', $users);
        return $view;
    }

    public function search(Request $request, $subsidiary_id)
    {
        // dd($_POST);
        $subsidiary = Subsidiary::find($subsidiary_id);
        $profiles = Profile::all();

        $searched_profiles = Profile::where('name', 'like', '%'.$request->search_inp.'%')->get();

        $users = User::where('subsidiary_id', $subsidiary_id)->where( function($query) use ($request, $searched_profiles) {
            $query->where('username', 'LIKE', '%'.$request->search_inp.'%')
            ->orWhere( function ($q) use ($searched_profiles) {
                foreach ($searched_profiles as $profile) {
                    $q->orWhere('profile_id', $profile->id);
                }
            });
        });

        $users = $users->paginate(20);

        $view = view('subsidiaries.edit', ['subsidiary'=>$subsidiary, 'users'=>$users, 'search_inp'=>$request->search_inp, 'profiles'=>$profiles]);

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subsidiary_id)
    {
        $subsidiaries = Subsidiary::orderBy('name', 'asc')->get();
        $profiles = Profile::all();

        $view = view('auth.register', ['subsidiary_id'=>$subsidiary_id, 'subsidiaries'=>$subsidiaries, 'profiles'=>$profiles]);
        return $view;
    }

    public function create_by_request($request_id)
    {
        $request = AccessRequest::find($request_id);
        $username = strstr($request->email, '@', true);
        $profiles = Profile::all();
        // $domain = substr($request->email, strpos($request->email, "@") + 1);
        // $subsidiary_name = strstr($domain, '.', true);
        $subsidiaries = Subsidiary::orderBy('name', 'asc')->get();

        $view = view('auth.register_by_request', ['request'=>$request, 'username'=>$username, 'subsidiaries'=>$subsidiaries, 'profiles'=>$profiles]);
        return $view;
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
        if ($request->subsidiary) {
            $this->validate($request, [
                // 'username'  =>  'required',
                'email'     => 'required|email|max:255|unique:users',
                'password'  => 'required|min:6',
                'profile'    => 'required',
                'subsidiary' => 'required',
            ]);
        }
        else {
            $this->validate($request, [
                // 'username'  =>  'required',
                'email'     => 'required|email|max:255|unique:users',
                'password'  => 'required|min:6',
                'profile'    => 'required',
            ]);
        }
        $user = new User;
        $username = strstr($request->email, '@', true);

        $nb_users_in_db = User::where('username', 'like', $username.'%')->count();
        if ($nb_users_in_db > 0) {
            $user->username = $username.$nb_users_in_db;
        }
        else {
            $user->username = $username;
        }

        // $user->username = $username;
        $user->email = $request->email;
        $user->password  = bcrypt($request->password);
        $user->profile_id = $request->profile;

        if ($request->subsidiary) {
            $user->subsidiary_id = $request->subsidiary;
        }
        else {
            $user->subsidiary_id = $subsidiary_id;
        }

        $user->save();

        $access_request = AccessRequest::where('email', $request->email)->first();

        if ($access_request) {
            AccessRequest::destroy($access_request->id);
        }

        //If $request->subsidiary exist, we want to go to the request access page
        // if ($request->subsidiary) {
            return redirect()->action('UserController@edit', [$subsidiary_id, $user->id])->with('status', 'User created!');
            // return redirect()->action('SubsidiaryController@edit', $subsidiary_id);
        // }
        // else {
        //     return redirect()->action('SubsidiaryController@edit', $subsidiary_id);
        // }
    }

    public function store_by_request(Request $request)
    {
        // dd($_POST);
        $this->validate($request, [
            'username'  =>  'required',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6',
            'profile'    => 'required',
            'subsidiary' => 'required',
        ]);
        $user = new User;
        // $user->username = $request->username;
        $username = strstr($request->email, '@', true);

        $nb_users_in_db = User::where('username', 'like', $username.'%')->count();
        if ($nb_users_in_db > 0) {
            $user->username = $username.$nb_users_in_db;
        }
        else {
            $user->username = $username;
        }
        $user->email = $request->email;
        $user->password  = bcrypt($request->password);
        $user->profile_id = $request->profile;
        $user->subsidiary_id = $request->subsidiary;

        $user->save();

        $access_request = AccessRequest::where('email', $request->email)->first();

        AccessRequest::destroy($access_request->id);

        $profiles = Profile::all();

        // return redirect()->action('AccessController@index');
        return view('auth.edit', ['subsidiary_id'=>$request->subsidiary, 'user'=>$user, 'created_from_request'=>true, 'profiles'=>$profiles]);
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
    public function edit($subsidiary_id, $user_id)
    {
        $user = User::find($user_id);
        $profiles = Profile::all();
        $entities = Subsidiary::orderBy('name')->get();
        $view = view('auth.edit', ['subsidiary_id'=>$subsidiary_id, 'user'=>$user, 'profiles'=>$profiles, 'entities'=>$entities]);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary_id, $user_id)
    {
        // dd($_POST);
        $this->validate($request, [
            'username' => 'required|max:255',
            'email'     => 'required|email|max:255',
        ]);

        $user = User::find($user_id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->profile_id = $request->profile;
        $user->subsidiary_id = $request->entity;

        $user->save();

        return redirect()->action('SubsidiaryController@edit', $subsidiary_id)->with('update', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $subsidiary_id, $user_id)
    {
        // dd($_POST);
        $user = User::find($user_id);
        $user->profile()->dissociate();
        $user->save();

        User::destroy($user_id);

        if ($request->return_to_access_requests) {
            return redirect()->action('AccessController@index')->with('update', 'User deleted!');
        }
        else {
            return redirect()->action('SubsidiaryController@edit', $subsidiary_id)->with('update', 'User deleted!');
        }

        // dd($_POST);
        // $ids = $request->input('id');
        // User::destroy($ids);

        // return redirect()->action('UserController@index');
    }

    public function destroyOne($id)
    {
        // dd($_POST);
        User::destroy($id);

        return redirect()->action('UserController@index');
    }

    public function authenticate(Request $request)
    {
        // dd($_POST);
        // $this->validate($request, [
        //     'username' => 'required|max:255|exists:users,username',
        //     'password'     => 'required|email|max:255',
        // ]);

        $messages = [
            'exists' => "This :attribute doesn't exist."
        ];

        $this->validate($request, [
            'username' => 'required|exists:users,username',
            'password'     => 'required|max:255',
        ], $messages);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // Authentication passed...
            // if (Auth::user()->profile == 'Basic user') {
            //     return redirect()->action('ReferenceController@index');
            // }
            // else {
            //     return redirect()->intended('home');
            // }
            return redirect()->intended('home');
        }
        else {
            return redirect()->action('UserController@getLoginWrongPassword');
        }
    }

    public function getLoginError(Request $request)
    {
        $view = view('auth.loginError');
        return $view;
    }

    public function getLoginWrongPassword()
    {
        $view = view('auth.loginWrongPassword');
        return $view;
    }

    public function manageAccount($id)
    {
        $user = User::find($id);
        $profile = Profile::find($user->profile_id);

        $view = view('auth.account_management', ['user'=>$user, 'profile'=>$profile]);

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


        // $view = view('home');

        // return $view;
        return redirect()->action('HomeController@index');
    }

    public function change_password_page()
    {
        $view = view('auth.password');
        return $view;
    }

    public function retrieve_password(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
        ]);

        return redirect()->action('Auth\AuthController@getLogin')->with('status', 'An email was sent to you!');
        // return view('auth.login');
    }
}
