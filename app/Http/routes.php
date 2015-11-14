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

//Authentication
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('login', 'UserController@authenticate');

//Google Authentication
Route::get('auth/google', 'Auth\OAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\OAuthController@handleProviderCallback');

//Home
Route::get('home', 'HomeController@index');

//Subsidiaries
Route::delete('subsidiaries/destroy_multi', 'SubsidiaryController@destroyMulti');
Route::resource('subsidiaries', 'SubsidiaryController');

//References
Route::get('references/search', 'ReferenceController@search');
Route::get('references/results', 'ReferenceController@results');
Route::resource('references', 'ReferenceController');

//Users
Route::delete('user/destroyOne/{id}', 'UserController@destroyOne');
Route::post('user/search', 'UserController@search');
Route::resource('user', 'UserController');

//Middleware
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Services
Route::post('subservice/storeExternal', 'SubServiceController@storeExternal');
Route::post('subservice/storeInternal', 'SubServiceController@storeInternal');
Route::post('services/search', 'SubServiceController@search');
Route::get('services/internal', 'SubServiceController@veoliaIndex');
Route::delete('services/destroyOne/{id}', 'SubServiceController@destroyOne');
Route::get('services/create_internal', 'SubServiceController@internalCreate');
Route::resource('services', 'SubServiceController');

//Domains
Route::delete('domains/destroyOne/{id}', 'DomainController@destroyOne');
Route::resource('domains', 'DomainController');

//Expertises
Route::delete('expertises/destroyOne', 'ExpertiseController@destroyOne');
Route::resource('domains.expertises', 'ExpertiseController');

//Categories
Route::resource('categories', 'CategoryController');

//Measures
Route::resource('categories.measures', 'MeasureController');