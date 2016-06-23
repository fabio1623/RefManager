<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AccessRequest;
use App\Subsidiary;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'create',
            'store',
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access = AccessRequest::paginate(100);
        $subsidiaries = Subsidiary::all();

        $view = view('requests.index', ['access'=>$access, 'subsidiaries'=>$subsidiaries]);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subsidiaries = Subsidiary::orderBy('name', 'asc')->get();

        $view = view('auth.access_request', ['subsidiaries'=>$subsidiaries]);
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
        $messages = [
            'required'  => 'The :attribute field is required.',
            'unique'    => 'You already asked for an account or you actually have one.'
        ];

        $this->validate($request, [
            'email' => 'required|email|unique:users|unique:access_requests',
            'company' => 'required',
        ], $messages);

        $access = new AccessRequest;
        $access->email = $request->email;
        $access->subsidiary_id = $request->company;

        $access->save();

        $subsidiary = Subsidiary::findOrFail($access->subsidiary_id);

        Mail::queue('emails.request_sent', ['access'=>$access, 'subsidiary'=>$subsidiary], function($message) use ($subsidiary) {
            $message->from('noreply@seureca.com', 'Refmanager');
            $message->to('sarmentopedrofabio@gmail.com')->subject('New access request for '.$subsidiary->name);
        });

        // $requests = AccessRequest::where('seen', 0)->get();

        // $requests_number = count($requests);

        // view()->share('requests_number', $requests_number);

        return redirect()->action('Auth\AuthController@getLogin')->with('status', 'Your request has been sent!');
        // return view('auth.loginRequestSent');
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
    public function destroyOne($id)
    {
        // dd($id);
        AccessRequest::destroy($id);

        return redirect()->action('AccessController@index');
    }
}
