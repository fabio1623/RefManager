<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Authentication route through google API
Route::get('/', 'Auth\AuthController@redirectToProvider');
Route::get('/callback', 'Auth\AuthController@handleProviderCallback');

//Home route
Route::get('home', 'HomeController@index');

//References routes
Route::get('references/index', 'ReferenceController@index');
Route::get('references/search', 'ReferenceController@search');
Route::get('references/results', 'ReferenceController@results');
Route::resource('references', 'ReferenceController');

//User routes
Route::post('user/search', 'UserController@search');
Route::resource('user', 'UserController');



/*Route::get('auth/index', 'UserController@index');*/

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

/*Route::resource('accounts', 'AccountController');*/

/*Route::get('/', 'WelcomeController@index');*/