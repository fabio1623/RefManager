<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reference;
use App\Service;
use App\Domain;
use App\Expertise;
use App\Category;
use App\Country;
use App\Zone;
use App\Contributor;
use App\ExternalService;
use App\InternalService;
use App\MeasureValues;
use App\QualifierValues;
use App\Language;
use App\LanguageReference;
use App\Client;
use App\Measure;
use App\Contact;
use App\Funding;
use App\ContributorReference;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $references = Reference::paginate(8);
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();

        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones]);
        return $view;
    }

    public function customize()
    {
        $languages = Language::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();

        $seniors = Contributor::where('profile', 'In-house')
                                    ->orderBy('name', 'asc')
                                    ->get();
        $experts = Contributor::where('profile', 'In-house')
                                    ->orWhere('profile', 'Sub-contractor')
                                        ->orderBy('name', 'asc')
                                        ->get();

        $consultants = Contributor::where('profile', 'Consultant')
                                        ->orderBy('name', 'asc')
                                        ->get();

        $view = view('references.customize', ['languages'=>$languages, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'zones'=>$zones, 'seniors'=>$seniors, 'experts'=>$experts, 'consultants'=>$consultants]);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $internal_services = Service::where('subsidiary','Seureca')
        //                                 ->where('service_type', 'internal')
        //                                 ->first()
        //                                 ->subServices()->get();
        // $external_services = Service::where('subsidiary','Seureca')
        //                                 ->where('service_type', 'external')
        //                                 ->first()
        //                                 ->subServices()->get();

        $language_codes = array(
        'en' => 'English' , 
        'aa' => 'Afar' , 
        'ab' => 'Abkhazian' , 
        'af' => 'Afrikaans' , 
        'am' => 'Amharic' , 
        'ar' => 'Arabic' , 
        'as' => 'Assamese' , 
        'ay' => 'Aymara' , 
        'az' => 'Azerbaijani' , 
        'ba' => 'Bashkir' , 
        'be' => 'Byelorussian' , 
        'bg' => 'Bulgarian' , 
        'bh' => 'Bihari' , 
        'bi' => 'Bislama' , 
        'bn' => 'Bengali/Bangla' , 
        'bo' => 'Tibetan' , 
        'br' => 'Breton' , 
        'ca' => 'Catalan' , 
        'co' => 'Corsican' , 
        'cs' => 'Czech' , 
        'cy' => 'Welsh' , 
        'da' => 'Danish' , 
        'de' => 'German' , 
        'dz' => 'Bhutani' , 
        'el' => 'Greek' , 
        'eo' => 'Esperanto' , 
        'es' => 'Spanish' , 
        'et' => 'Estonian' , 
        'eu' => 'Basque' , 
        'fa' => 'Persian' , 
        'fi' => 'Finnish' , 
        'fj' => 'Fiji' , 
        'fo' => 'Faeroese' , 
        'fr' => 'French' , 
        'fy' => 'Frisian' , 
        'ga' => 'Irish' , 
        'gd' => 'Scots/Gaelic' , 
        'gl' => 'Galician' , 
        'gn' => 'Guarani' , 
        'gu' => 'Gujarati' , 
        'ha' => 'Hausa' , 
        'hi' => 'Hindi' , 
        'hr' => 'Croatian' , 
        'hu' => 'Hungarian' , 
        'hy' => 'Armenian' , 
        'ia' => 'Interlingua' , 
        'ie' => 'Interlingue' , 
        'ik' => 'Inupiak' , 
        'in' => 'Indonesian' , 
        'is' => 'Icelandic' , 
        'it' => 'Italian' , 
        'iw' => 'Hebrew' , 
        'ja' => 'Japanese' , 
        'ji' => 'Yiddish' , 
        'jw' => 'Javanese' , 
        'ka' => 'Georgian' , 
        'kk' => 'Kazakh' , 
        'kl' => 'Greenlandic' , 
        'km' => 'Cambodian' , 
        'kn' => 'Kannada' , 
        'ko' => 'Korean' , 
        'ks' => 'Kashmiri' , 
        'ku' => 'Kurdish' , 
        'ky' => 'Kirghiz' , 
        'la' => 'Latin' , 
        'ln' => 'Lingala' , 
        'lo' => 'Laothian' , 
        'lt' => 'Lithuanian' , 
        'lv' => 'Latvian/Lettish' , 
        'mg' => 'Malagasy' , 
        'mi' => 'Maori' , 
        'mk' => 'Macedonian' , 
        'ml' => 'Malayalam' , 
        'mn' => 'Mongolian' , 
        'mo' => 'Moldavian' , 
        'mr' => 'Marathi' , 
        'ms' => 'Malay' , 
        'mt' => 'Maltese' , 
        'my' => 'Burmese' , 
        'na' => 'Nauru' , 
        'ne' => 'Nepali' , 
        'nl' => 'Dutch' , 
        'no' => 'Norwegian' , 
        'oc' => 'Occitan' , 
        'om' => '(Afan)/Oromoor/Oriya' , 
        'pa' => 'Punjabi' , 
        'pl' => 'Polish' , 
        'ps' => 'Pashto/Pushto' , 
        'pt' => 'Portuguese' , 
        'qu' => 'Quechua' , 
        'rm' => 'Rhaeto-Romance' , 
        'rn' => 'Kirundi' , 
        'ro' => 'Romanian' , 
        'ru' => 'Russian' , 
        'rw' => 'Kinyarwanda' , 
        'sa' => 'Sanskrit' , 
        'sd' => 'Sindhi' , 
        'sg' => 'Sangro' , 
        'sh' => 'Serbo-Croatian' , 
        'si' => 'Singhalese' , 
        'sk' => 'Slovak' , 
        'sl' => 'Slovenian' , 
        'sm' => 'Samoan' , 
        'sn' => 'Shona' , 
        'so' => 'Somali' , 
        'sq' => 'Albanian' , 
        'sr' => 'Serbian' , 
        'ss' => 'Siswati' , 
        'st' => 'Sesotho' , 
        'su' => 'Sundanese' , 
        'sv' => 'Swedish' , 
        'sw' => 'Swahili' , 
        'ta' => 'Tamil' , 
        'te' => 'Tegulu' , 
        'tg' => 'Tajik' , 
        'th' => 'Thai' , 
        'ti' => 'Tigrinya' , 
        'tk' => 'Turkmen' , 
        'tl' => 'Tagalog' , 
        'tn' => 'Setswana' , 
        'to' => 'Tonga' , 
        'tr' => 'Turkish' , 
        'ts' => 'Tsonga' , 
        'tt' => 'Tatar' , 
        'tw' => 'Twi' , 
        'uk' => 'Ukrainian' , 
        'ur' => 'Urdu' , 
        'uz' => 'Uzbek' , 
        'vi' => 'Vietnamese' , 
        'vo' => 'Volapuk' , 
        'wo' => 'Wolof' , 
        'xh' => 'Xhosa' , 
        'yo' => 'Yoruba' , 
        'zh' => 'Chinese' , 
        'zu' => 'Zulu' , 
        );
        $languages = Language::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();
        $fundings = Funding::all();
        // $countries = [];
        // foreach ($zones as $zone) {
        //     for ($i=0; $i < $zone->countries->count()-1; $i++) { 
        //         $countries[] = $zone->countries[$i];
        //     }
        // }

        $seniors = Contributor::where('profile', 'In-house')
                                    ->orderBy('name', 'asc')
                                    ->get();
        $experts = Contributor::where('profile', 'In-house')
                                    ->orWhere('profile', 'Sub-contractor')
                                        ->orderBy('name', 'asc')
                                        ->get();

        $consultants = Contributor::where('profile', 'Consultant')
                                        ->orderBy('name', 'asc')
                                        ->get();


        /*dd($internal_services);*/
        $view = view('references.create', ['languages'=>$languages, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'zones'=>$zones, 'seniors'=>$seniors, 'experts'=>$experts, 'consultants'=>$consultants, 'fundings'=>$fundings]);
        return $view;
    }

    public function basic_search(Request $request)
    {
        // dd($_POST);

        //If search input filed, search the corresponding references, otherwise get all references
        if ($request->search_input) {
            $references = Reference::where('project_number', 'LIKE', '%'.$request->search_input.'%')
                            ->orWhere('dfac_name', 'LIKE', '%'.$request->search_input.'%')
                            ->orWhere('start_date', 'LIKE', '%'.$request->search_input.'%')
                            ->orWhere('end_date', 'LIKE', '%'.$request->search_input.'%')
                            ->orWhere(function ($query) use ($request) {
                                $query->where('total_project_cost', '=', floatval($request->search_input))
                                      ->where('total_project_cost', '<>', 0);
                            });

            $searched_countries = Country::where('name', 'like', '%'.$request->search_input.'%')->get();
            // dd($searched_countries);

            foreach ($searched_countries as $value) {
                // dd($value->id);
                $references = $references->whereNotNull('country')->orWhere('country', $value->id);
            }

            $references = $references->paginate(8);
        }
        else {
            $references = Reference::paginate(8);
        }

        $countries = Country::all();
        $zones = Zone::all();
        $clients = Client::all();
        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'inputs'=>$request->except('page')]);
        return $view;
    }

    public function search()
    {
        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();
        $categories = Category::all();
        $zones = Zone::all();

        $view = view('references.search', ['zones'=>$zones, 'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'categories'=>$categories, 'zones'=>$zones]);
        return $view;
    }

    public function results(Request $request)
    {
        // dd($_GET);

        //Get right references
        $references = Reference::where(function ($query) use ($request) {
                                    $countries = Country::where('name', 'LIKE', '%'.$request->keyword.'%')->get();
                                    $contacts = Contact::where('name', 'LIKE', '%'.$request->keyword.'%')->get();
                                    $clients = Client::where('name', 'LIKE', '%'.$request->keyword.'%')->get();
                                    $query->where('project_number', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('dfac_name', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('estimated_duration', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('project_name', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('service_name', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('project_description', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('service_description', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('general_comments', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('location', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('project_name_fr', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('service_name_fr', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('project_description_fr', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('service_description_fr', 'LIKE', '%'.$request->keyword.'%')
                                          ->orWhere('dfac_name', 'LIKE', '%'.$request->keyword.'%');
                                          if ($countries) {
                                            foreach ($countries as $country) {
                                                $query->orWhere('country', $country->id);
                                            }
                                          }
                                          if ($contacts) {
                                            foreach ($contacts as $contact) {
                                                $query->orWhere('contact', $contact->id);
                                            }
                                          }
                                          if ($clients) {
                                            foreach ($clients as $client) {
                                                $query->orWhere('client', $client->id);
                                            }
                                          }
                                });

        //If country input set, add the right country to request
        if ($request->country) {
            $references->whereIn('country', $request->country);
        }

        //If zone input set, add the right zone to request
        if ($request->zone) {
            $references->whereIn('zone', $request->zone);
        }

        //If services input set, add the right services to request
        if ($request->service) {
            $external = [];
            $internal = [];

            foreach ($request->service as $value) {
                if ($value[0] == 'e') {
                    $external[] = substr($value, 1);
                }
                else {
                    $internal[] = substr($value, 1);
                }
            }
            if (count($external) > 0) {
                $references->whereHas('external_services', function ($query) use ($external) {
                    $query->whereIn('id', $external);
                });
            }
            if (count($internal) > 0) {
                $references->whereHas('internal_services', function ($query) use ($internal) {
                    $query->whereIn('id', $internal);
                });
            }
        }

        //If domains input set, add the right domains to request
        if ($request->domain) {
            //Get list of selected domains
            $selected_domains = [];
            foreach ($request->domain as $value) {
                $selected_domains[] = $value;
            }

            $nb_selected_domains = count($request->domain);
            
            //Filter request to remove references with less expertises than domains selected
            $filtered_references = Reference::has('expertises', '>=', $nb_selected_domains)->get();
            $references_to_get = [];

            //For each filtered reference, check if there are at least linked to selected domains
            foreach ($filtered_references as $ref) {
                $domains_in_ref = [];

                foreach ($ref->expertises as $exp) {
                    if (in_array($exp->domain_id, $selected_domains) && (!in_array($exp->domain_id, $domains_in_ref))) {
                        $domains_in_ref[] = $exp->domain_id;
                    }
                }

                if (count($domains_in_ref) >= $nb_selected_domains) {
                    $references_to_get[] = $ref->id;
                }
            }

            $references->whereIn('id', $references_to_get);

            ////Other version with ORM
            // $references->whereHas('expertises', function ($query) use ($selected_domains) {
            //     $query->whereIn('domain_id', $selected_domains);
            // });
        }

        //Get the references corresponding to the selected measure value
        if ($request->measure != '') {
            $measure_type;
            $references->whereHas('measures', function ($query) use ($request) {
                $query->where('measure_id', $request->measure_type)
                        ->where('value', $request->measure_symbol, $request->measure);
            });
        }

        //If start date set with radio selected, get the corresponding references
        if ($request->started != '' && $request->ended != '') {
            $references->whereBetween('start_date', [$request->started, $request->ended])
                        ->orWhereBetween('end_date', [$request->started, $request->ended]);
        }
        else {
            if ($request->started != '') {
                if ($request->started_radio) {
                    $references->where('start_date', $request->started_radio, $request->started)
                                ->orWhere('start_date', '');
                }
            }
            else {
                if ($request->ended != '') {
                    if ($request->ended_radio) {
                        $references->where('end_date', $request->ended_radio, $request->ended)
                                    ->orWhere('end_date', '');
                    }
                }
            }
        }   

        //Get the right references corresponding to the selected criteria
        if ($request->cost != '') {
            $cost_type;
            $cost_symbol;
            switch ($request->cost_type) {
                case 'Total cost':
                    $cost_type = 'total_project_cost';
                    break;
                case 'Seureca services':
                    $cost_type = 'seureca_services_cost';
                    break;
                case 'Works':
                    $cost_type = 'work_cost';
                    break;
                default:
                    # code...
                    break;
            }

            $references->where($cost_type, $request->cost_symbol, $request->cost);
        }

        

        $references = $references->paginate(8);

        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();
        $clients = Client::all();

        $view = view('references.results', ['references'=>$references, 'zones'=>$zones,'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'clients'=>$clients, 'inputs'=>$request->except('page')]);
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
        $this->validate($request, [
            'project_number'    =>  'required|unique:references',
            // 'country'           =>  'required',
            // 'zone'              =>  'required',
            // 'client'            =>  'required',
            // 'contact'           =>  'required',
        ]);

        $reference = new Reference;

        //Description panel
        $reference->project_number = $request->input('project_number');

        if ($request->input('confidential')) {
            $reference->confidential = true;
        }
        else {
            $reference->confidential = false;   
        }

        $reference->dfac_name = $request->input('dfac_name');
        if ($request->input('country') != "") {
            $reference->country = $request->input('country');
        }
        if ($request->input('zone') != "") {
            $reference->zone = $request->input('zone');
        }

        $reference->location = $request->input('location');

        $reference->start_date = $request->input('start_date');
        $reference->end_date = $request->input('end_date');

        $reference->estimated_duration = $request->input('estimated_duration');

        //Details panel
        $reference->project_name = $request->input('project_name');
        $reference->project_name = $request->input('project_name_fr');
        $reference->project_name = $request->input('project_description');
        $reference->project_name = $request->input('project_description_fr');
        $reference->project_name = $request->input('service_name');
        $reference->project_name = $request->input('service_name_fr');
        $reference->project_name = $request->input('service_description');
        $reference->project_name = $request->input('service_description_fr');
        
        if ($request->input('staff_number')) {
            $reference->staff_number = $request->input('staff_number');
        }

        if ($request->input('seureca_man_months')) {
            $reference->seureca_man_months = $request->input('seureca_man_months');
        }

        if ($request->input('consultants_man_months')) {
            $reference->consultants_man_months = $request->input('consultants_man_months');
        }

        //Contact infos
        if ($request->input('contact_name') != "") {
            $contact_in_db = Contact::where('name', $request->input('contact_name'))->first();

            if ($contact_in_db == null) {
                $new_contact = new Contact;
                $new_contact->name = $request->input('contact_name');

                $new_contact->save();

                $reference->contact = $new_contact->id;
            }
            else {
                $reference->contact = $contact_in_db->id;
            }
        }

        $reference->contact_department = $request->input('contact_department');
        $reference->contact_department_fr = $request->input('contact_department_fr');
        $reference->contact_phone = $request->input('contact_phone');
        $reference->contact_email = $request->input('contact_email');
        
        //Client infos
        if ($request->input('client_name_en') != "") {
            $client_in_db_en = Client::where('name', $request->input('client_name_en'))
                                        ->orWhere('name_fr', $request->input('client_name_en'))->first();

            if ($client_in_db_en == null) {
                if ($request->input('client_name_fr') != "") {
                    $client_in_db_fr = Client::where('name', $request->input('client_name_fr'))
                                        ->orWhere('name_fr', $request->input('client_name_fr'))->first();
                    if ($client_in_db_fr == null) {
                        $new_client = new Client;
                        $new_client->name = $request->input('client_name_en');
                        $new_client->name_fr = $request->input('client_name_fr');

                        $new_client->save();

                        $reference->client = $new_client->id;
                    }
                    else {
                        $reference->client = $client_in_db_fr->id;
                        if ($client_in_db_fr->name == "") {
                            $client_in_db_fr->name = $request->input('client_name_en');

                            $client_in_db_fr->save();
                        }
                    }
                }
                else {
                    $new_client = new Client;
                    $new_client->name = $request->input('client_name_en');

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
             }
             else {
                $reference->client = $client_in_db_en->id;
                if ($client_in_db_en->name_fr == "") {
                    $client_in_db_en->name_fr = $request->input('client_name_fr');

                    $client_in_db_en->save(); 
                }
             }
        }
        else {
            if ($request->input('client_name_fr') != "") {
                $client_in_db_fr = Client::where('name', $request->input('client_name_fr'))
                                            ->orWhere('name_fr', $request->input('client_name_fr'))->first();
                if ($client_in_db_fr == null) {
                    $new_client = new Client;
                    $new_client->name_fr = $request->input('client_name_fr');

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
                else {
                    $reference->client = $client_in_db_fr->id;
                }
            }
        }

        //Costs & currency infos
        $reference->total_project_cost = $request->input('total_project_cost');
        $reference->seureca_services_cost = $request->input('seureca_services_cost');
        $reference->work_cost = $request->input('work_cost');

        $reference->currency = $request->input('project_currency');

        if ($reference->currency == "Dollars") {
            $url = "https://currency-api.appspot.com/api/EUR/USD.json?amount=1.00";

            $result = file_get_contents($url);
            $result = json_decode($result);

            if ($result->success) {
                $reference->rate = $result->rate;
            }
        }
        else {
            $reference->rate = 1;
        }

        // if ($request->input('languages.English.8') != "") {
        //     $client_in_db = Client::where('name', $request->input('languages.English.8'))->first();
        //     // dd($client_in_db);
        //     if ($client_in_db == null) {
        //         $new_client = new Client;
        //         $new_client->name = $request->input('languages.English.8');

        //         $new_client->save();

        //         $reference->client_id = $new_client->id;
        //     }
        //     else {
        //         $reference->client_id = $client_in_db->id;
        //     }
        // }

        $reference->save();

        // dd($_POST);

        //Attach the external services
        if($request->input('external')) {
            foreach ($request->input('external') as $key => $external_service) {
                $reference->external_services()->attach($key);
            }
        }

        //Attach the internal services
        if($request->input('internal')) {
            foreach ($request->input('internal') as $key => $internal_service) {
                $reference->internal_services()->attach($key);
            }
        }

        //Attach the expertises
        if($request->input('domains')) {
            foreach ($request->input('domains') as $domain) {
                foreach ($domain as $key => $value) {
                    $reference->expertises()->attach($key);
                }
            }
        }

        //Attach the measures
        foreach ($request->input('categories') as $category) {
            foreach ($category as $key => $value) {
                $measure_in_db = Measure::where('id', $key)->first();

                if (count($measure_in_db->units) > 1) {
                    $reference->measures()->attach($key, ['value' => $value, 'unit' => $request->units[$key]]);
                }
                else {
                    $reference->measures()->attach($key, ['value' => $value]);   
                }
            }
        }

        //Attach the qualifiers to the measures
        if ($request->input('qualifiers')) {
            foreach ($request->input('qualifiers') as $qualifiers) {
                foreach ($qualifiers as $key => $value) {
                    $reference->qualifiers()->attach($key);
                }
            }
        }
        //Attach the translations to the reference
        // foreach ($request->input('languages') as $key => $language) {
        //     $language_in_db = Language::where('name', $key)->first();

        //     $reference->languages()->attach($language_in_db->id, ['project_name'=>$language[0], 'project_description'=>$language[1], 'service_name'=>$language[2], 'service_description'=>$language[3], 'experts'=>$language[4], 'contact_name'=>$language[5], 'contact_department'=>$language[6], 'contact_email'=>$language[7], 'client'=>$language[8], 'financing'=>$language[9], 'general_comments'=>$language[10]]);
        // }

        //Attach the fundings
        if ($request->financing) {
            foreach ($request->financing as $f) {
                $funding_in_db = Funding::where('name', $f)
                                            ->orWhere('name_fr', $f)->first();
                if ($funding_in_db) {
                    if ($funding_in_db->name == '') {
                        $funding_in_db->name = $f;

                        $funding_in_db->save();
                    }
                    $reference->fundings()->attach($funding_in_db->id);
                }
                else {
                    $new_funding = new Funding;
                    $new_funding->name = $f;

                    $new_funding->save();

                    $reference->fundings()->attach($new_funding->id);
                }
            }
        }

        if ($request->financing_fr) {
            foreach ($request->financing_fr as $f) {
                $funding_in_db = Funding::where('name', $f)
                                            ->orWhere('name_fr', $f)->first();
                if ($funding_in_db) {
                    if ($funding_in_db->name_fr == '') {
                        $funding_in_db->name_fr = $f;

                        $funding_in_db->save();
                    }
                    $reference->fundings()->attach($funding_in_db->id);
                }
                else {
                    $new_funding = new Funding;
                    $new_funding->name_fr = $f;

                    $new_funding->save();

                    $reference->fundings()->attach($new_funding->id);
                }
            }
        }

        //Attach the involved staff
        foreach ($request->involved_staff as $key => $value) {
            if ($value != '') {
                $staff_in_db = Contributor::where('name', $value)->first();

                if ($staff_in_db) {
                    $reference->contributors()->attach($staff_in_db->id, ['responsability_on_project'=>$request->involved_staff_function[$key]]);
                }
                else {
                    $new_staff = new Contributor;
                    $new_staff->name = $value;

                    $new_staff->save();
                    $reference->contributors()->attach($new_staff->id, ['responsability_on_project'=>$request->involved_staff_function[$key]]);
                }
            }
        }

        //Attach the experts
        foreach ($request->experts as $key => $value) {
            if ($value != '') {
                $expert_in_db = Contributor::where('name', $value)->first();

                if ($expert_in_db) {
                    $reference->contributors()->attach($expert_in_db->id, ['responsability_on_project'=>$request->expert_functions[$key], 'function_on_project'=>'Expert']);
                }
                else {
                    $new_expert = new Contributor;
                    $new_expert->name = $value;

                    $new_expert->save();
                    $reference->contributors()->attach($new_expert->id, ['responsability_on_project'=>$request->expert_functions[$key], 'function_on_project'=>'Expert']);
                }
            }
        }

        //Attach the consultants
        foreach ($request->consultants as $key => $value) {
            if ($value != '') {
                $consultant_in_db = Contributor::where('name', $value)->first();

                if ($consultant_in_db) {
                    $reference->contributors()->attach($consultant_in_db->id, ['function_on_project'=>'Consultant']);
                }
                else {
                    $new_consultant = new Contributor;
                    $new_consultant->name = $value;

                    $new_consultant->save();

                    $reference->contributors()->attach($new_consultant->id, ['function_on_project'=>'Consultant']);
                }
            }
        }


        return redirect()->action('ReferenceController@edit', $reference->id);
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
        $reference = Reference::find($id);

        $measures_values = MeasureValues::where('reference_id', $id)->get();

        $qualifiers_values = QualifierValues::where('reference_id', $id)->get();

        $languages = Language::all();

        $languagesValues = LanguageReference::where('reference_id', $id)->get();

        $contact = Contact::find($reference->contact);
        $client = Client::find($reference->client);

        //Get contributors
        $staff_involved = ContributorReference::where('reference_id', $reference->id)
                                                ->where('function_on_project', 'Senior')->get();

        $staff_name = $reference->contributors()->where('function_on_project', 'Senior')->get();

        $experts = ContributorReference::where('reference_id', $reference->id)
                                            ->where('function_on_project', 'Expert')->get();

        $experts_name = $reference->contributors()->where('function_on_project', 'Expert')->get();

        $consultants = $reference->contributors()->where('function_on_project', 'Consultant')->get();

        $financings = $reference->fundings()->get();
        
        // dd($staff_names);

        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();

        $view = view('references.edit', ['reference'=>$reference, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'zones'=>$zones, 'measures_values'=>$measures_values, 'qualifiers_values'=>$qualifiers_values, 'languages'=>$languages, 'languagesValues'=>$languagesValues, 'client'=>$client, 'contact'=>$contact, 'staff_involved'=>$staff_involved, 'staff_name'=>$staff_name, 'experts'=>$experts, 'experts_name'=>$experts_name, 'consultants'=>$consultants, 'financings'=>$financings]);
        
        return $view;
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
        // dd($_POST);
        // $this->validate($request, [
        //     'project_number' => 'required|unique:references',
        //     'country_id'     => 'required',
        // ]);

        $reference = Reference::find($id);

        //Description panel
        $reference->project_number = $request->input('project_number');

        if ($request->input('confidential')) {
            $reference->confidential = 1;
        }
        else{
            $reference->confidential = 0;   
        }

        $reference->dfac_name = $request->input('dfac_name');
        
        if ($request->input('country') != "") {
            $reference->country = $request->input('country');
        }
        else {
            $reference->country = null;
        }

        if ($request->input('zone') != "") {
            $reference->zone = $request->input('zone');
        }
        else {
            $reference->zone = null;
        }

        $reference->location = $request->input('location');
        $reference->start_date = $request->input('start_date');
        $reference->end_date = $request->input('end_date');
        $reference->estimated_duration = $request->input('estimated_duration');
        
        //Details panel
        $reference->project_name = $request->input('project_name');
        $reference->project_name_fr = $request->input('project_name_fr');
        $reference->project_description = $request->input('project_description');
        $reference->project_description_fr = $request->input('project_description_fr');
        $reference->service_name = $request->input('service_name');
        $reference->service_name_fr = $request->input('service_name_fr');
        $reference->service_description = $request->input('service_description');
        $reference->service_description_fr = $request->input('service_description_fr');
        $reference->staff_number = $request->input('staff_number');
        $reference->seureca_man_months = $request->input('seureca_man_months');
        $reference->consultants_man_months = $request->input('consultants_man_months');

        //Contact infos
        if ($request->input('contact_name') != "") {
            $contact_in_db = Contact::where('name', $request->input('contact_name'))->first();

            if ($contact_in_db == null) {
                $new_contact = new Contact;
                $new_contact->name = $request->input('contact_name');

                $new_contact->save();

                $reference->contact = $new_contact->id;
            }
            else {
                $reference->contact = $contact_in_db->id;
            }
        }

        $reference->contact_department = $request->input('contact_department_en');
        $reference->contact_department_fr = $request->input('contact_department_fr');
        $reference->contact_phone = $request->input('contact_phone');
        $reference->contact_email = $request->input('contact_email');

        //Client infos
        if ($request->input('client_name_en') != "") {
            $client_in_db_en = Client::where('name', $request->input('client_name_en'))
                                        ->orWhere('name_fr', $request->input('client_name_en'))->first();

            if ($client_in_db_en == null) {
                if ($request->input('client_name_fr') != "") {
                    $client_in_db_fr = Client::where('name', $request->input('client_name_fr'))
                                        ->orWhere('name_fr', $request->input('client_name_fr'))->first();
                    if ($client_in_db_fr == null) {
                        $new_client = new Client;
                        $new_client->name = $request->input('client_name_en');
                        $new_client->name_fr = $request->input('client_name_fr');

                        $new_client->save();

                        $reference->client = $new_client->id;
                    }
                    else {
                        $reference->client = $client_in_db_fr->id;
                        if ($client_in_db_fr->name == "") {
                            $client_in_db_fr->name = $request->input('client_name_en');

                            $client_in_db_fr->save();
                        }
                    }
                }
                else {
                    $new_client = new Client;
                    $new_client->name = $request->input('client_name_en');

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
             }
             else {
                $reference->client = $client_in_db_en->id;
                if ($client_in_db_en->name_fr == "") {
                    $client_in_db_en->name_fr = $request->input('client_name_fr');

                    $client_in_db_en->save(); 
                }
             }
        }
        else {
            if ($request->input('client_name_fr') != "") {
                $client_in_db_fr = Client::where('name', $request->input('client_name_fr'))
                                            ->orWhere('name_fr', $request->input('client_name_fr'))->first();
                if ($client_in_db_fr == null) {
                    $new_client = new Client;
                    $new_client->name_fr = $request->input('client_name_fr');

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
                else {
                    $reference->client = $client_in_db_fr->id;
                }
            }
        }

        $reference->total_project_cost = $request->input('total_project_cost');
        $reference->seureca_services_cost = $request->input('seureca_services_cost');
        $reference->work_cost = $request->input('work_cost');
        $reference->general_comments = $request->input('general_comments');
        $reference->general_comments_fr = $request->input('general_comments_fr');

        $reference->currency = $request->input('project_cost_currency');

        if ($reference->currency == "Dollars") {
            $url = "https://currency-api.appspot.com/api/EUR/USD.json?amount=1.00";

            $result = file_get_contents($url);
            $result = json_decode($result);

            if ($result->success) {

                $reference->rate = $result->rate;
            }
        }
        else {
            $reference->rate = 1;
        }

        $reference->save();

        //Detach all external services
        $reference->external_services()->detach();

        //Attach the external services
        if($request->input('external')) {
            foreach ($request->input('external') as $key => $external_service) {
                $reference->external_services()->attach($key);
            }
        }

        //Detach all internal services
        $reference->internal_services()->detach();

        //Attach the internal services
        if($request->input('internal')) {
            foreach ($request->input('internal') as $key => $internal_service) {
                $reference->internal_services()->attach($key);
            }
        }

        //Detach all expertises
        $reference->expertises()->detach();

        //Attach the expertises
        if($request->input('domains')) {
            foreach ($request->input('domains') as $domain) {
                foreach ($domain as $key => $value) {
                    $reference->expertises()->attach($key);
                }
            }
        }

        //Detach all measures
        $reference->measures()->detach();

        //Attach the measures
        foreach ($request->input('categories') as $category) {
            foreach ($category as $key => $value) {
                $measure_in_db = Measure::where('id', $key)->first();

                if (count($measure_in_db->units) > 1) {
                    $reference->measures()->attach($key, ['value' => $value, 'unit' => $request->units[$key]]);
                }
                else {
                    $reference->measures()->attach($key, ['value' => $value]);   
                }
            }
        }

        //Detach all qualifiers
        $reference->qualifiers()->detach();

        //Attach the qualifiers to the measures
        if ($request->input('qualifiers')) {
            foreach ($request->input('qualifiers') as $qualifiers) {
                foreach ($qualifiers as $key => $value) {
                    $reference->qualifiers()->attach($key);
                }
            }
        }
        //Detach all translations
        $reference->languages()->detach();

        //Attach the translations to the reference
        foreach ($request->input('languages') as $key => $language) {
            $language_in_db = Language::where('name', $key)->first();

            $reference->languages()->attach($language_in_db->id, ['project_name'=>$language[0], 'project_description'=>$language[1], 'service_name'=>$language[2], 'service_description'=>$language[3], 'experts'=>$language[4], 'contact_name'=>$language[5], 'contact_department'=>$language[6], 'contact_email'=>$language[7], 'client'=>$language[8], 'financing'=>$language[9], 'general_comments'=>$language[10]]);
        }

        //Detach all fundings
        $reference->fundings()->detach();

        //Attach the fundings to the reference
        if ($request->financing) {
            foreach ($request->financing as $f) {
                $funding_in_db = Funding::where('name', $f)
                                            ->orWhere('name_fr', $f)->first();
                if ($funding_in_db) {
                    if ($funding_in_db->name == '') {
                        $funding_in_db->name = $f;

                        $funding_in_db->save();
                    }
                    $reference->fundings()->attach($funding_in_db->id);
                }
                else {
                    $new_funding = new Funding;
                    $new_funding->name = $f;

                    $new_funding->save();

                    $reference->fundings()->attach($new_funding->id);
                }
            }
        }

        if ($request->financing_fr) {
            foreach ($request->financing_fr as $f) {
                $funding_in_db = Funding::where('name', $f)
                                            ->orWhere('name_fr', $f)->first();
                if ($funding_in_db) {
                    if ($funding_in_db->name_fr == '') {
                        $funding_in_db->name_fr = $f;

                        $funding_in_db->save();
                    }
                    $linked_funding = $reference->fundings()->where('name', $funding_in_db->name)
                                                            ->orWhere('name_fr', $funding_in_db->name_fr)->first();
                    if (!$linked_funding) {
                        $reference->fundings()->attach($funding_in_db->id);
                    }
                }
                else {
                    $new_funding = new Funding;
                    $new_funding->name_fr = $f;

                    $new_funding->save();

                    $reference->fundings()->attach($new_funding->id);
                }
            }
        }

        //Detach all contributors
        $reference->contributors()->detach();

        //Attach the contributors
        //Attach the involved staff
        foreach ($request->involved_staff as $key => $value) {
            if ($value != '') {
                $staff_in_db = Contributor::where('name', $value)->first();

                if ($staff_in_db) {
                    $reference->contributors()->attach($staff_in_db->id, ['responsability_on_project'=>$request->involved_staff_function[$key]]);
                }
                else {
                    $new_staff = new Contributor;
                    $new_staff->name = $value;

                    $new_staff->save();
                    $reference->contributors()->attach($new_staff->id, ['responsability_on_project'=>$request->involved_staff_function[$key]]);
                }
            }
        }

        //Attach the experts
        foreach ($request->experts as $key => $value) {
            if ($value != '') {
                $expert_in_db = Contributor::where('name', $value)->first();

                if ($expert_in_db) {
                    $reference->contributors()->attach($expert_in_db->id, ['responsability_on_project'=>$request->expert_functions[$key], 'function_on_project'=>'Expert']);
                }
                else {
                    $new_expert = new Contributor;
                    $new_expert->name = $value;

                    $new_expert->save();
                    $reference->contributors()->attach($new_expert->id, ['responsability_on_project'=>$request->expert_functions[$key], 'function_on_project'=>'Expert']);
                }
            }
        }

        //Attach the consultants
        foreach ($request->consultants as $key => $value) {
            if ($value != '') {
                $consultant_in_db = Contributor::where('name', $value)->first();

                if ($consultant_in_db) {
                    $reference->contributors()->attach($consultant_in_db->id, ['function_on_project'=>'Consultant']);
                }
                else {
                    $new_consultant = new Contributor;
                    $new_consultant->name = $value;

                    $new_consultant->save();

                    $reference->contributors()->attach($new_consultant->id, ['function_on_project'=>'Consultant']);
                }
            }
        }

        return redirect()->action('ReferenceController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($_POST);
        $ids = $request->input('id');

        foreach ($ids as $id) {
            $reference = Reference::find($id);
            $reference->external_services()->detach();
            $reference->internal_services()->detach();
            $reference->expertises()->detach();
            $reference->measures()->detach();
            $reference->qualifiers()->detach();
            $reference->languages()->detach();
            $reference->fundings()->detach();
            $reference->contributors()->detach();
        }

        Reference::destroy($ids);

        return redirect()->action('ReferenceController@index');
    }
}
