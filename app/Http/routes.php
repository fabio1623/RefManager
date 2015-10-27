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

// Authentication routes...
Route::get('/', 'Auth\AuthController@getLogin');

//Authentication route through google API
Route::get('auth/google', 'Auth\OAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\OAuthController@handleProviderCallback');


//Home route
Route::get('home', 'HomeController@index');


//References routes
Route::get('references/index', [
	'middleware' => 'auth',
	'uses' => 'ReferenceController@index'
]);
Route::get('references/search', [
	'middleware' => 'auth',
	'uses' => 'ReferenceController@search'
]);
Route::get('references/results', [
	'middleware' => 'auth',
	'uses' => 'ReferenceController@results'
]);
Route::get('references/create', [
	'middleware' => 'auth',
	'uses' => 'ReferenceController@create'
]);


//Route protection not implemented
/*Route::resource('references', 'ReferenceController');*/


// //User routes
// Route::get('user/index', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@index'
// ]);
// Route::get('user/create', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@create'
// ]);
// Route::get('user/{id}/edit', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@edit'
// ]);
// Route::put('user/update/{id}', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@update'
// ]);
// Route::post('user/store', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@store'
// ]);
// Route::post('user/store', 'UserController@store');
// Route::delete('user/destroy/{id}', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@destroy'
// ]);
// Route::delete('user/destroyOne/{id}', [
// 	'middleware' => 'auth',
// 	'uses' => 'UserController@destroyOne'
// ]);
Route::post('user/search', 'UserController@search');
Route::resource('user', 'UserController');



/*Route::get('auth/index', 'UserController@index');*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*Route::resource('accounts', 'AccountController');*/

/*Route::get('/', 'WelcomeController@index');*/

// Authentication routes...
/*Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/

Route::post('subservice/storeExternal', 'SubServiceController@storeExternal');
Route::post('subservice/storeInternal', 'SubServiceController@storeInternal');
Route::get('subservice/index', 'SubServiceController@index');
Route::delete('subservice/destroy', 'SubServiceController@destroy');