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
Route::get('loginError_password', 'UserController@getLoginWrongPassword');

//Google Authentication
Route::get('auth/google', 'Auth\OAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\OAuthController@handleProviderCallback');

//Grant Access
Route::get('access_requests/destroyOne/{id}', 'AccessController@destroyOne');
Route::resource('access_requests', 'AccessController');

//Default Passwords
Route::get('default_password/edit', 'DefaultPasswordController@manage_password');
Route::resource('default_password', 'DefaultPasswordController');

//Home
Route::post('upload', 'HomeController@upload_file');
Route::get('home/contact_us', 'HomeController@contact_us');
Route::get('home', 'HomeController@index');

//Subsidiaries
Route::delete('subsidiaries/destroy_multi', 'SubsidiaryController@destroyMulti');
Route::resource('subsidiaries', 'SubsidiaryController');

//References
Route::post('references/{reference}/delete', 'ReferenceController@delete_file');
// Route::get('references/{reference}/files/{file}/delete', 'ReferenceController@delete_file');
Route::post('references/{reference}/download', 'ReferenceController@download_file');
// Route::get('references/{reference}/files/{file}/download', 'ReferenceController@download_file');
Route::post('references/{reference}/upload', 'ReferenceController@upload_file');
Route::get('references/index_created_by_me', 'ReferenceController@index_created_by_me');
Route::get('references/index_approved', 'ReferenceController@index_approved');
Route::get('references/index_to_approve', 'ReferenceController@index_to_approve');
Route::get('references/search/results_by_project_number', 'ReferenceController@results_by_project_number');
Route::get('references/approve/{id}', 'ReferenceController@approve');
Route::get('references/disapprove/{id}', 'ReferenceController@disapprove');
Route::get('references/custom_index/{id}', 'ReferenceController@subsidiary_references');
Route::get('references/search', 'ReferenceController@search');
Route::get('references/search/results', 'ReferenceController@results');
Route::get('references/customize', 'ReferenceController@customize');
Route::get('references/basic_search', 'ReferenceController@basic_search');
Route::post('references/{reference}/link_translation', 'ReferenceController@link_translation');
Route::get('references/{reference}/languages/{language}/detach_translation', 'ReferenceController@detach_translation');
Route::get('references/{reference}/{error}/edit', 'ReferenceController@edit');
Route::resource('references', 'ReferenceController');

//Users
Route::get('user/destroyOne/{id}', 'UserController@destroyOne');
Route::get('subsidiaries/{subsidiary}/edit/search', 'UserController@search');
Route::get('user/create_by_request/{request}', 'UserController@create_by_request');
Route::post('users/create_by_request/store_by_request', 'UserController@store_by_request');
Route::get('user/account_management/{id}', 'UserController@manageAccount');
Route::post('user/account_update/{id}', 'UserController@updateAccount');
Route::resource('subsidiaries.users', 'UserController');

//Middleware
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Internal services
Route::get('subsidiaries/{subsidiary}/internal_services/subsidiary_internal_services', 'ServiceController@subsidiary_internal_services');
Route::post('subsidiaries/{subsidiary}/link_internal_service', 'ServiceController@link_internal_service');
Route::get('subsidiaries/{subsidiary}/internal_services/{internal_service}/detach_internal_service', 'ServiceController@detach_internal_service');
Route::get('subsidiaries/{subsidiary}/internal_services', 'ServiceController@internal_index');
Route::get('subsidiaries/{subsidiary}/internal_services/create', 'ServiceController@internal_create');
Route::post('subsidiaries/{subsidiary}/internal_services/store', 'ServiceController@internal_store');
Route::get('subsidiaries/{subsidiary}/internal_services/{internal_service}/edit', 'ServiceController@internal_edit');
Route::put('subsidiaries/{subsidiary}/internal_services/{internal_service}', 'ServiceController@internal_update');
Route::delete('subsidiaries/{subsidiary}/internal_services/{internal_service}', 'ServiceController@internal_destroy');

//External services
Route::get('subsidiaries/{subsidiary}/external_service/subsidiary_external_services', 'ServiceController@subsidiary_external_services');
Route::post('subsidiaries/{subsidiary}/link_external_service', 'ServiceController@link_external_service');
Route::get('subsidiaries/{subsidiary}/external_service/{external_service}/detach_external_service', 'ServiceController@detach_external_service');
Route::resource('subsidiaries.external_service', 'ServiceController');

//Domains
Route::get('subsidiaries/{subsidiary}/domains/{domain}/custom_edit', 'DomainController@custom_edit');
Route::post('subsidiaries/{subsidiary}/link_domain', 'DomainController@link_domain');
Route::get('subsidiaries/{subsidiary}/domains/{domain}/detach_domain', 'DomainController@detach_domain');
Route::get('subsidiaries/{subsidiary}/domains', 'DomainController@custom_index');
Route::resource('subsidiaries.domains', 'DomainController');

//Expertises
Route::post('subsidiaries/{subsidiary}/domains/{domain}/link_expertise', 'ExpertiseController@link_expertise');
Route::get('subsidiaries/{subsidiary}/expertises/{expertise}/detach_expertise', 'ExpertiseController@detach_expertise');
Route::resource('subsidiaries.domains.expertises', 'ExpertiseController');

//Categories
Route::get('subsidiaries/{subsidiary}/categories/{category}/custom_edit', 'CategoryController@custom_edit');
Route::get('subsidiaries/{subsidiary}/categories/custom_index', 'CategoryController@custom_index');
Route::post('subsidiaries/{subsidiary}/link_category', 'CategoryController@link_category');
Route::get('subsidiaries/{subsidiary}/categories/{category}/detach_category', 'CategoryController@detach_category');
Route::resource('subsidiaries.categories', 'CategoryController');

//Measures
Route::post('subsidiaries/{subsidiary}/categories/{category}/link_measure', 'MeasureController@link_measure');
Route::get('subsidiaries/{subsidiary}/measures/{measure}/detach_measure', 'MeasureController@detach_measure');
Route::resource('subsidiaries.categories.measures', 'MeasureController');

//Zones
Route::put('zones/attach_country/{id}', 'ZoneController@attach_country');
Route::get('zones/{zone}/countries/{country}/detach_country', 'ZoneController@detach_country');
Route::delete('zones/destroy_multiple', 'ZoneController@destroyMultiple');
Route::resource('subsidiaries.zones', 'ZoneController');

//Countries
Route::resource('zones.countries', 'CountryController');

//Contributors
Route::delete('subsidiaries/{subsidiary}/zones/{zone}/contributors/destroy_multiple', 'ContributorController@destroyMultiple');
Route::get('subsidiaries/{subsidiary}/contributors/custom_create', 'ContributorController@custom_create');
Route::post('subsidiaries/{subsidiary}/zones/{zone}/contributors/custom_store', 'ContributorController@custom_store');
Route::resource('subsidiaries.zones.contributors', 'ContributorController');

//Fundings
Route::delete('fundings/destroy_multiple', 'FundingController@destroyMultiple');
Route::resource('fundings', 'FundingController');

//Files generation
Route::get('references/{reference}/generate_file_wb_en', 'ReferenceController@generate_file_wb_en');
Route::get('references/{reference}/generate_file_wb_fr', 'ReferenceController@generate_file_wb_fr');
Route::get('references/{reference}/generate_file_eu_en', 'ReferenceController@generate_file_eu_en');
Route::get('references/{reference}/generate_file_eu_fr', 'ReferenceController@generate_file_eu_fr');
Route::get('references/{reference}/generate_file_es', 'ReferenceController@generate_file_es');
Route::get('references/{reference}/languages/{language}/generate_file_translations', 'ReferenceController@generate_file_translations');
Route::get('{template}/{kind_of_file}/reference/{reference}/generate_file_base', 'ReferenceController@generate_file_base');
Route::post('{template}/{kind_of_file}/generate_file_base_multiple', 'ReferenceController@generate_file_base_multiple');
// Route::post('languages/{language}/generate_file_translations_multiple', 'ReferenceController@generate_file_translations_multiple');
Route::post('generate_file_translations_multiple', 'ReferenceController@generate_file_translations_multiple');
Route::get('subsidiaries/{subsidiary}/match_page', 'ReferenceController@match_page');

//Languages
Route::post('subsidiaries/{subsidiary}/link_languages', 'LanguageController@link_languages');
Route::get('subsidiaries/{subsidiary}/search', 'LanguageController@search');
Route::resource('subsidiaries.languages', 'LanguageController');

//Templates
Route::post('templates/upload', 'TemplateController@upload_template');
Route::get('templates/{language}/download', 'TemplateController@download_template');
Route::get('templates/{language}/delete', 'TemplateController@delete_template');
Route::resource('templates', 'TemplateController');

Route::get('test', function () {

});