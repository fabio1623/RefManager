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
Route::post('users/create_by_request', 'UserController@createByRequest');
Route::get('user/account_management/{id}', 'UserController@manageAccount');
Route::post('user/account_update/{id}', 'UserController@updateAccount');
Route::resource('users', 'UserController');

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

//Zones
Route::put('zones/attach_country/{id}', 'ZoneController@attach_country');
Route::put('zones/detach_country/{id}', 'ZoneController@detach_country');
Route::delete('zones/destroy_multiple', 'ZoneController@destroyMultiple');
Route::resource('zones', 'ZoneController');

//Countries
Route::resource('zones.countries', 'CountryController');

Route::get('test', function () {
    $countryList = array(
            "Africa" => array(
                "DZ" => "Algeria",
                "AO" => "Angola",
                "BJ" => "Benin",
                "BW" => "Botswana",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "CM" => "Cameroon",
                "CV" => "Cape Verde",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "KM" => "Comoros",
                "CG" => "Congo - Brazzaville",
                "CD" => "Congo - Kinshasa",
                "CI" => "Côte d’Ivoire",
                "DJ" => "Djibouti",
                "EG" => "Egypt",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "ET" => "Ethiopia",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GH" => "Ghana",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "KE" => "Kenya",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libya",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "ML" => "Mali",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "NA" => "Namibia",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "RW" => "Rwanda",
                "RE" => "Réunion",
                "SH" => "Saint Helena",
                "SN" => "Senegal",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "SD" => "Sudan",
                "SZ" => "Swaziland",
                "ST" => "São Tomé and Príncipe",
                "TZ" => "Tanzania",
                "TG" => "Togo",
                "TN" => "Tunisia",
                "UG" => "Uganda",
                "EH" => "Western Sahara",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
            ),
            "America" => array(
                "AI" => "Anguilla",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AW" => "Aruba",
                "BS" => "Bahamas",
                "BB" => "Barbados",
                "BZ" => "Belize",
                "BM" => "Bermuda",
                "BO" => "Bolivia",
                "BR" => "Brazil",
                "VG" => "British Virgin Islands",
                "CA" => "Canada",
                "KY" => "Cayman Islands",
                "CL" => "Chile",
                "CO" => "Colombia",
                "CR" => "Costa Rica",
                "CU" => "Cuba",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "EC" => "Ecuador",
                "SV" => "El Salvador",
                "FK" => "Falkland Islands",
                "GF" => "French Guiana",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GT" => "Guatemala",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HN" => "Honduras",
                "JM" => "Jamaica",
                "MQ" => "Martinique",
                "MX" => "Mexico",
                "MS" => "Montserrat",
                "AN" => "Netherlands Antilles",
                "NI" => "Nicaragua",
                "PA" => "Panama",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PR" => "Puerto Rico",
                "BL" => "Saint Barthélemy",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "MF" => "Saint Martin",
                "PM" => "Saint Pierre and Miquelon",
                "VC" => "Saint Vincent and the Grenadines",
                "SR" => "Suriname",
                "TT" => "Trinidad and Tobago",
                "TC" => "Turks and Caicos Islands",
                "VI" => "U.S. Virgin Islands",
                "US" => "United States",
                "UY" => "Uruguay",
                "VE" => "Venezuela",
            ),
            "Asia" => array(
                "AF" => "Afghanistan",
                "AM" => "Armenia",
                "AZ" => "Azerbaijan",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BT" => "Bhutan",
                "BN" => "Brunei",
                "KH" => "Cambodia",
                "CN" => "China",
                "CY" => "Cyprus",
                "GE" => "Georgia",
                "HK" => "Hong Kong SAR China",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran",
                "IQ" => "Iraq",
                "IL" => "Israel",
                "JP" => "Japan",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Laos",
                "LB" => "Lebanon",
                "MO" => "Macau SAR China",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "MN" => "Mongolia",
                "MM" => "Myanmar [Burma]",
                "NP" => "Nepal",
                "NT" => "Neutral Zone",
                "KP" => "North Korea",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PS" => "Palestinian Territories",
                "YD" => "People's Democratic Republic of Yemen",
                "PH" => "Philippines",
                "QA" => "Qatar",
                "SA" => "Saudi Arabia",
                "SG" => "Singapore",
                "KR" => "South Korea",
                "LK" => "Sri Lanka",
                "SY" => "Syria",
                "TW" => "Taiwan",
                "TJ" => "Tajikistan",
                "TH" => "Thailand",
                "TL" => "Timor-Leste",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "AE" => "United Arab Emirates",
                "UZ" => "Uzbekistan",
                "VN" => "Vietnam",
                "YE" => "Yemen",
            ),
            "Europe" => array(
                "AL" => "Albania",
                "AD" => "Andorra",
                "AT" => "Austria",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BA" => "Bosnia and Herzegovina",
                "BG" => "Bulgaria",
                "HR" => "Croatia",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DD" => "East Germany",
                "EE" => "Estonia",
                "FO" => "Faroe Islands",
                "FI" => "Finland",
                "FR" => "France",
                "DE" => "Germany",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GG" => "Guernsey",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IE" => "Ireland",
                "IM" => "Isle of Man",
                "IT" => "Italy",
                "JE" => "Jersey",
                "LV" => "Latvia",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MK" => "Macedonia",
                "MT" => "Malta",
                "FX" => "Metropolitan France",
                "MD" => "Moldova",
                "MC" => "Monaco",
                "ME" => "Montenegro",
                "NL" => "Netherlands",
                "NO" => "Norway",
                "PL" => "Poland",
                "PT" => "Portugal",
                "RO" => "Romania",
                "RU" => "Russia",
                "SM" => "San Marino",
                "RS" => "Serbia",
                "CS" => "Serbia and Montenegro",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "ES" => "Spain",
                "SJ" => "Svalbard and Jan Mayen",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "UA" => "Ukraine",
                "SU" => "Union of Soviet Socialist Republics",
                "GB" => "United Kingdom",
                "VA" => "Vatican City",
                "AX" => "Åland Islands",
            ),
            "Oceania" => array(
                "AS" => "American Samoa",
                "AQ" => "Antarctica",
                "AU" => "Australia",
                "BV" => "Bouvet Island",
                "IO" => "British Indian Ocean Territory",
                "CX" => "Christmas Island",
                "CC" => "Cocos [Keeling] Islands",
                "CK" => "Cook Islands",
                "FJ" => "Fiji",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GU" => "Guam",
                "HM" => "Heard Island and McDonald Islands",
                "KI" => "Kiribati",
                "MH" => "Marshall Islands",
                "FM" => "Micronesia",
                "NR" => "Nauru",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "PW" => "Palau",
                "PG" => "Papua New Guinea",
                "PN" => "Pitcairn Islands",
                "WS" => "Samoa",
                "SB" => "Solomon Islands",
                "GS" => "South Georgia and the South Sandwich Islands",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TV" => "Tuvalu",
                "UM" => "U.S. Minor Outlying Islands",
                "VU" => "Vanuatu",
                "WF" => "Wallis and Futuna",
            ),
        );
	
	dd($countryList);
});