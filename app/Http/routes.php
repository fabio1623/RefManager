<?php
use App\Domain;
use App\Expertise;
use App\Qualifier;
use App\Measure;
use App\Reference;
use App\MeasureValues;
use App\Language;

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
Route::get('loginError', 'UserController@getLoginError');

//Google Authentication
Route::get('auth/google', 'Auth\OAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\OAuthController@handleProviderCallback');

//Grant Access
Route::get('access_requests/destroyOne/{id}', 'AccessController@destroyOne');
Route::resource('access_requests', 'AccessController');

//Default Passwords
Route::get('default_password/edit', 'DefaultPasswordController@manage_password');

//Home
Route::get('home', 'HomeController@index');

//Subsidiaries
Route::delete('subsidiaries/destroy_multi', 'SubsidiaryController@destroyMulti');
Route::resource('subsidiaries', 'SubsidiaryController');

//References
Route::get('references/search', 'ReferenceController@search');
Route::get('references/search/results', 'ReferenceController@results');
Route::get('references/customize', 'ReferenceController@customize');
Route::get('references/basic_search', 'ReferenceController@basic_search');
Route::resource('references', 'ReferenceController');

//Users
Route::get('user/destroyOne/{id}', 'UserController@destroyOne');
Route::get('user/search', 'UserController@search');
Route::get('user/create_by_request/{id}', 'UserController@create_by_request');
Route::post('users/create_by_request/store_by_request', 'UserController@store_by_request');
Route::get('user/account_management/{id}', 'UserController@manageAccount');
Route::post('user/account_update/{id}', 'UserController@updateAccount');
Route::resource('users', 'UserController');

//Middleware
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Internal services
Route::get('services/internal', 'ServiceController@internal_index');
Route::get('services/internal/create', 'ServiceController@internal_create');
Route::post('services/internal/store', 'ServiceController@internal_store');
Route::get('services/internal/{id}/edit', 'ServiceController@internal_edit');
Route::put('services/internal/{id}', 'ServiceController@internal_update');
Route::delete('service/internal/{id}', 'ServiceController@internal_destroy');
Route::delete('services/internal/destroy_multiple/{id}', 'ServiceController@internal_destroy_multiple');

//External services
Route::delete('services/external/destroy_multiple/{id}', 'ServiceController@destroy_multiple');
Route::resource('services/external', 'ServiceController');

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

//Zones
Route::put('zones/attach_country/{id}', 'ZoneController@attach_country');
Route::put('zones/detach_country/{id}', 'ZoneController@detach_country');
Route::delete('zones/destroy_multiple', 'ZoneController@destroyMultiple');
Route::resource('zones', 'ZoneController');

//Countries
Route::resource('zones.countries', 'CountryController');

Route::get('test', function () {

});