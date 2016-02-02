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
Route::get('references/custom_index/{id}', 'ReferenceController@subsidiary_references');
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
Route::get('services/internal/subsidiary_internal_services', 'ServiceController@subsidiary_internal_services');
Route::get('services/internal/link_internal_service/{id}', 'ServiceController@link_internal_service');
Route::get('services/internal/detach_internal_service/{id}', 'ServiceController@detach_internal_service');
Route::get('services/internal', 'ServiceController@internal_index');
Route::get('services/internal/create', 'ServiceController@internal_create');
Route::post('services/internal/store', 'ServiceController@internal_store');
Route::get('services/internal/{id}/edit', 'ServiceController@internal_edit');
Route::put('services/internal/{id}', 'ServiceController@internal_update');
Route::delete('service/internal/{id}', 'ServiceController@internal_destroy');
Route::delete('services/internal/destroy_multiple/{id}', 'ServiceController@internal_destroy_multiple');

//External services
Route::get('services/external/subsidiary_external_services', 'ServiceController@subsidiary_external_services');
Route::get('services/external/link_external_service/{id}', 'ServiceController@link_external_service');
Route::get('services/external/detach_external_service/{id}', 'ServiceController@detach_external_service');
Route::delete('services/external/destroy_multiple/{id}', 'ServiceController@destroy_multiple');
Route::resource('services/external', 'ServiceController');

//Domains
Route::get('domains/{domain}/subsidiary/{subsidiary}/custom_edit', 'DomainController@custom_edit');
Route::delete('domains/destroyOne/{id}', 'DomainController@destroyOne');
Route::get('domains/{domain}/link_domain/{id}', 'DomainController@link_domain');
Route::get('domains/{domain}/detach_domain/{id}', 'DomainController@detach_domain');
Route::get('domains/custom_index/{id}', 'DomainController@custom_index');
Route::resource('domains', 'DomainController');

//Expertises
Route::get('expertises/{expertise}/link_expertise/{id}', 'ExpertiseController@link_expertise');
Route::get('expertises/{expertise}/detach_expertise/{id}', 'ExpertiseController@detach_expertise');
Route::delete('expertises/destroyOne', 'ExpertiseController@destroyOne');
Route::resource('domains.expertises', 'ExpertiseController');

//Categories
Route::get('categories/{category}/subsidiary/{subsidiary}/custom_edit', 'CategoryController@custom_edit');
Route::get('categories/custom_index/{id}', 'CategoryController@custom_index');
Route::get('categories/{categories}/link_category/{id}', 'CategoryController@link_category');
Route::get('categories/{categories}/detach_category/{id}', 'CategoryController@detach_category');
Route::resource('categories', 'CategoryController');

//Measures
Route::get('measures/{measure}/link_measure/{id}', 'MeasureController@link_measure');
Route::get('measures/{measure}/detach_measure/{id}', 'MeasureController@detach_measure');
Route::resource('categories.measures', 'MeasureController');

//Zones
Route::put('zones/attach_country/{id}', 'ZoneController@attach_country');
Route::put('zones/detach_country/{id}', 'ZoneController@detach_country');
Route::delete('zones/destroy_multiple', 'ZoneController@destroyMultiple');
Route::resource('zones', 'ZoneController');

//Countries
Route::resource('zones.countries', 'CountryController');

//Contributors
Route::delete('contributors/destroy_multiple', 'ContributorController@destroyMultiple');
Route::resource('contributors', 'ContributorController');

//Fundings
Route::delete('fundings/destroy_multiple', 'FundingController@destroyMultiple');
Route::resource('fundings', 'FundingController');

Route::get('test', function () {

});