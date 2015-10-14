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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('references/index', 'ReferenceController@index');

Route::get('references/search', 'ReferenceController@search');

Route::get('references/results', 'ReferenceController@results');

/*Route::get('auth/index', 'UserController@index');*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('references', 'ReferenceController');

/*Route::resource('accounts', 'AccountController');*/

Route::get('user/search', 'UserController@search');

Route::resource('user', 'UserController');

