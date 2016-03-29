<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage;
use File;
use ZipArchive;
use Auth;
use Excel;

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
use App\Subsidiary;
use App\CountryZone;

use \PhpOffice\PhpWord\TemplateProcessor;

class ReferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $references = Reference::orderBy('created_at', 'desc')->paginate(20);
        $references = Reference::orderBy('created_at', 'desc')->get();
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();
        $kind_of_reference = 'All';
        $languages = Language::has('references')->get();
        $categories = Category::all();

        $ref_array = array();
        foreach ($references as $key => $reference) {
            $cat_array = array();
            foreach ($reference->measures as $measure) {
                if (in_array($measure->category_id, $cat_array) == false) {
                    array_push($cat_array, $measure->category_id);
                }
            }
            $ref_array[$reference->id] = $cat_array;
        }

        $view = view('references.index', ['categories'=>$categories, 'ref_array'=>$ref_array, 'references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages]);
        return $view;
    }

    public function subsidiary_references($id)
    {
        $subsidiary = Subsidiary::find($id);
        $references = $subsidiary->references()->paginate(8);
        // $references = Reference::paginate(8);
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();
        $kind_of_reference = 'From '.$subsidiary->name;

        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'kind_of_reference'=>$kind_of_reference]);
        return $view; 
    }

    public function index_to_approve()
    {
        $references = Reference::where('dcom_approval', false)->orderBy('created_at', 'desc')->paginate(8);
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();
        $kind_of_reference = 'To approve';
        $languages = Language::has('references')->get();
        $categories = Category::all();

        $ref_array = array();
        foreach ($references as $key => $reference) {
            $cat_array = array();
            foreach ($reference->measures as $measure) {
                if (in_array($measure->category_id, $cat_array) == false) {
                    array_push($cat_array, $measure->category_id);
                }
            }
            $ref_array[$reference->id] = $cat_array;
        }

        $view = view('references.index', ['categories'=>$categories, 'ref_array'=>$ref_array, 'references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages]);
        return $view;

    }

    public function index_approved()
    {
        $references = Reference::where('dcom_approval', true)->orderBy('created_at', 'desc')->paginate(8);
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();
        $kind_of_reference = 'Approved';
        $languages = Language::has('references')->get();
        $categories = Category::all();

        $ref_array = array();
        foreach ($references as $key => $reference) {
            $cat_array = array();
            foreach ($reference->measures as $measure) {
                if (in_array($measure->category_id, $cat_array) == false) {
                    array_push($cat_array, $measure->category_id);
                }
            }
            $ref_array[$reference->id] = $cat_array;
        }

        $view = view('references.index', ['categories'=>$categories, 'ref_array'=>$ref_array, 'references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages]);
        return $view;        
    }

    public function index_created_by_me()
    {
        $references = Reference::where('created_by', Auth::user()->username)->orderBy('created_at', 'desc')->paginate(8);
        $countries = Country::all();
        $clients = Client::all();
        $zones = Zone::all();
        $kind_of_reference = 'Created by me';
        $languages = Language::has('references')->get();
        $categories = Category::all();

        $ref_array = array();
        foreach ($references as $key => $reference) {
            $cat_array = array();
            foreach ($reference->measures as $measure) {
                if (in_array($measure->category_id, $cat_array) == false) {
                    array_push($cat_array, $measure->category_id);
                }
            }
            $ref_array[$reference->id] = $cat_array;
        }

        $view = view('references.index', ['categories'=>$categories, 'ref_array'=>$ref_array, 'references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages]);
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
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $languages = Language::all();
        // $external_services = ExternalService::all();
        $external_services = $subsidiary->external_services()->get();
        // $internal_services = InternalService::all();
        $internal_services = $subsidiary->internal_services()->get();
        // $domains = Domain::all();
        $domains = $subsidiary->domains()->get();
        // $expertises = Expertise::all();
        $expertises = $subsidiary->expertises()->get();
        // $categories = Category::all();
        $categories = $subsidiary->categories()->get();
        $measures = $subsidiary->measures()->get();
        // $countries = Country::orderBy('name', 'asc')->get();
        $countries = Country::has('zones')->orderBy('name', 'asc')->get();
        $country_zone = CountryZone::all();
        $zones = Zone::orderBy('name','asc')->get();
        $zone_managers = Contributor::where('profile', 'In-house')->orderBy('name', 'asc')->get();
        $fundings = Funding::all();

        $seniors = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Senior');
        })->get();

        $experts = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Expert');
        })->get();

        $consultants = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Consultant');
        })->get();

        $senior_profiles = ContributorReference::where('function_on_project', 'Senior')->distinct()->get();
        $expert_profiles = ContributorReference::where('function_on_project', 'Expert')->distinct()->get();

        $contacts = Contact::all();
        $clients = Client::all();

        /*dd($internal_services);*/
        $view = view('references.create', ['languages'=>$languages, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'measures'=>$measures, 'countries'=>$countries, 'country_zone'=>$country_zone, 'zones'=>$zones, 'seniors'=>$seniors, 'experts'=>$experts, 'consultants'=>$consultants, 'fundings'=>$fundings, 'senior_profiles'=>$senior_profiles, 'expert_profiles'=>$expert_profiles, 'contacts'=>$contacts, 'clients'=>$clients, 'zone_managers'=>$zone_managers]);
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

            $references->where('dcom_approval', 1);

            $searched_countries = Country::where('name', 'like', '%'.$request->search_input.'%')->get();
            // dd($searched_countries);

            foreach ($searched_countries as $value) {
                // dd($value->id);
                $references = $references->whereNotNull('country')->orWhere('country', $value->id);
            }

            $references = $references->paginate(20);
        }
        else {
            $references = Reference::where('dcom_approval', 1)->paginate(20);
        }

        $countries = Country::all();
        $zones = Zone::all();
        $clients = Client::all();
        $kind_of_reference = 'All';
        $languages = Language::has('references')->get();

        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients, 'zones'=>$zones, 'inputs'=>$request->except('page'), 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages]);
        return $view;
    }

    public function search()
    {
        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        // $countries = Country::all();
        $countries = Country::has('zones')->orderBy('name', 'asc')->get();
        $categories = Category::all();
        $zones = Zone::all();
        $fundings = Funding::orderBy('name', 'asc')->get();

        $view = view('references.search', ['zones'=>$zones, 'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'categories'=>$categories, 'zones'=>$zones, 'fundings'=>$fundings]);
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

        $references->where('dcom_approval', 1);

        if ($request->continent) {
            $countries = Country::all();
            $countries_tab = [];
            foreach ($countries as $country) {
                foreach ($request->continent as $continent) {
                    if ($continent == $country->continent) {
                        $countries_tab[] = $country->id;
                    }
                }
                // if (array_has($request->continent, $country->continent)) {
                //     $countries_tab[] = $country->id;
                // }
            }
            // dd($countries_tab);
            $references->whereIn('country', $countries_tab);
        }

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

            //For each filtered reference, check if there is at least one linked to selected domains
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
            // $measure_type;
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

        if ($request->financings != '') {
            $financings = [];

            foreach ($request->financings as $value) {
                $financings[] = $value;
            }
            if (count($financings) > 0) {
                $references->whereHas('fundings', function ($query) use ($financings) {
                    $query->whereIn('id', $financings);
                });
            }
        }        

        // $references = $references->paginate(20);
        $references = $references->get();

        $ref_array = array();
        foreach ($references as $key => $reference) {
            $cat_array = array();
            foreach ($reference->measures as $measure) {
                if (in_array($measure->category_id, $cat_array) == false) {
                    array_push($cat_array, $measure->category_id);
                }
            }
            $ref_array[$reference->id] = $cat_array;
        }

        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();
        $clients = Client::all();
        $kind_of_reference = 'Search';
        $languages = Language::has('references')->get();
        $categories = Category::all();

        $view = view('references.index', ['categories'=>$categories, 'ref_array'=>$ref_array, 'kind_of_reference'=>$kind_of_reference, 'languages'=>$languages, 'references'=>$references, 'zones'=>$zones,'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'clients'=>$clients, 'inputs'=>$request->except('page')]);
        return $view;
    }

    public function results_by_project_number()
    {
        $references = Reference::orderBy('project_number', 'asc')->paginate(8);
        // dd($references);

        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();
        $clients = Client::all();

        $view = view('references.index', ['references'=>$references, 'zones'=>$zones,'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'clients'=>$clients]);
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

        $reference->start_date = $request->start_date;
        $reference->end_date = $request->end_date;

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
                        $new_client->address = $request->client_address;

                        $new_client->save();

                        $reference->client = $new_client->id;
                    }
                    else {
                        $reference->client = $client_in_db_fr->id;
                        if ($client_in_db_fr->name == "") {
                            $client_in_db_fr->name = $request->input('client_name_en');
                            if ($client_in_db_fr->address == '') {
                                $client_in_db_fr->address = $request->client_address;
                            }

                            $client_in_db_fr->save();
                        }
                    }
                }
                else {
                    $new_client = new Client;
                    $new_client->name = $request->input('client_name_en');
                    $new_client->address = $request->client_address;

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
             }
             else {
                $reference->client = $client_in_db_en->id;
                if ($client_in_db_en->name_fr == "") {
                    $client_in_db_en->name_fr = $request->input('client_name_fr');

                    if ($client_in_db_en == '') {
                        $client_in_db_en->address = $request->client_address;
                    }

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
                    $new_client->address = $request->client_address;

                    $new_client->save();

                    $reference->client = $new_client->id;
                }
                else {
                    $reference->client = $client_in_db_fr->id;
                }
            }
        }

        //Costs & currency infos
        if ($request->seureca_services_cost) {
            $reference->seureca_services_cost = $request->seureca_services_cost;
        }
        $reference->total_project_cost = $request->input('total_project_cost');
        // $reference->seureca_services_cost = $request->input('seureca_services_cost');
        $reference->work_cost = $request->input('work_cost');

        if ($request->project_currency == 'M $') {
            $reference->currency = 'Dollars';
        }
        else {
            $reference->currency = 'Euros';
        }
        // $reference->currency = $request->project_currency;

        if ($request->project_currency == "M $") {
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

        $reference->subsidiary_id = Auth::user()->subsidiary_id;
        $reference->created_by = Auth::user()->username;

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
        if ($request->categories) {
            foreach ($request->input('categories') as $category) {
                foreach ($category as $key => $value) {
                    if ($value != '') {
                        $measure_in_db = Measure::where('id', $key)->first();

                        if (count($measure_in_db->units) > 1) {
                            $reference->measures()->attach($key, ['value' => $value, 'unit' => $request->units[$key]]);
                        }
                        else {
                            $reference->measures()->attach($key, ['value' => $value]);   
                        }
                    }
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

        //Attach the fundings
        foreach ($request->financing as $key => $f) {
            if ($f[0] != '') {
                if ($f[1] != '') {
                    $funding_in_db = Funding::where('name', $f[0])->orWhere('name_fr', $f[1])->first();
                }
                else {
                    $funding_in_db = Funding::where('name', $f[0])->first();
                }
            }
            else {
                if ($f[1] != '') {
                    $funding_in_db = Funding::where('name_fr', $f[1])->first();
                }
                else {
                    $funding_in_db = null;
                }
            }
            if ($funding_in_db) {
                if ($funding_in_db->name == '') {
                    $funding_in_db->name = $f[0];
                    $funding_in_db->save();
                }
                if ($funding_in_db->name_fr == '') {
                     $funding_in_db->name_fr = $f[1];
                     $funding_in_db->save();
                }
                $reference->fundings()->attach($funding_in_db->id);
            }
            else {
                if ($f[0] != '' || $f[1] != '') {
                    $new_funding = new Funding;
                    if ($f[0] != '') {
                        $new_funding->name = $f[0];
                    }
                    if ($f[1] != '') {
                        $new_funding->name_fr = $f[1];
                    }
                    $new_funding->save();
                    $reference->fundings()->attach($new_funding->id);
                }
            }
        }

        //Attach the involved staff
        foreach ($request->involved_staff as $key => $staff) {
            if ($staff[0] != '') {
                $staff_in_db = Contributor::where('name', $staff[0])->first();

                if ($staff_in_db) {
                    $reference->contributors()->attach($staff_in_db->id, ['responsability_on_project'=>$staff[1], 'responsability_on_project_fr'=>$staff[2]]);
                }
                else {
                    $new_staff = new Contributor;
                    $new_staff->name = $staff[0];

                    $new_staff->save();
                    $reference->contributors()->attach($new_staff->id, ['responsability_on_project'=>$staff[1], 'responsability_on_project_fr'=>$staff[2]]);
                }
            }
            else {
                if ($staff[1] != '' || $staff[2] != '') {
                    $new_link = new ContributorReference;
                    $new_link->reference_id = $reference->id;
                    $new_link->responsability_on_project = $staff[1];
                    $new_link->responsability_on_project_fr = $staff[2];

                    $new_link->save();
                }
            }
        }

        //Attach the experts
        foreach ($request->experts as $key => $expert) {
            if ($expert[0] != '') {
                $expert_in_db = Contributor::where('name', $expert[0])->first();

                if ($expert_in_db) {
                    $reference->contributors()->attach($expert_in_db->id, ['responsability_on_project'=>$expert[1], 'responsability_on_project_fr'=>$expert[2], 'function_on_project'=>'Expert']);
                }
                else {
                    $new_expert = new Contributor;
                    $new_expert->name = $expert[0];

                    $new_expert->save();
                    $reference->contributors()->attach($new_expert->id, ['responsability_on_project'=>$expert[1], 'responsability_on_project_fr'=>$expert[2], 'function_on_project'=>'Expert']);
                }
            }
            else {
                if ($expert[1] != '' || $staff[2] != '') {
                    $new_link = new ContributorReference;
                    $new_link->reference_id = $reference->id;
                    $new_link->responsability_on_project = $expert[1];
                    $new_link->responsability_on_project_fr = $expert[2];
                    $new_link->function_on_project = 'Expert';

                    $new_link->save();
                }
            }
        }

        //Attach the consultants
        foreach ($request->consultants as $key => $consul) {
            if ($consul != '') {
                $consultant_in_db = Contributor::where('name', $consul)->first();

                if ($consultant_in_db) {
                    $reference->contributors()->attach($consultant_in_db->id, ['function_on_project'=>'Consultant']);
                }
                else {
                    $new_consultant = new Contributor;
                    $new_consultant->name = $consul;

                    $new_consultant->save();

                    $reference->contributors()->attach($new_consultant->id, ['function_on_project'=>'Consultant']);
                }
            }
        }

        Storage::makeDirectory('References/'.$reference->project_number);

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
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $reference = Reference::find($id);

        $measures_values = MeasureValues::where('reference_id', $id)->get();

        $qualifiers_values = QualifierValues::where('reference_id', $id)->get();

        // $languages = Language::all();
        // $languages = $reference->languages()->get();

        $linked_languages = $reference->languages()->get();

        $language_reference = LanguageReference::where('reference_id', $id)->get();

        // $languagesValues = LanguageReference::where('reference_id', $id)->get();

        $contact = Contact::find($reference->contact);
        $client = Client::find($reference->client);

        //Get contributors
        $staff_involved = ContributorReference::where('reference_id', $reference->id)
                                                ->where('function_on_project', 'Senior')->get();

        $staff_name = $reference->contributors()->where('function_on_project', 'Senior')->get();
        // dd($staff_involved);

        $experts = ContributorReference::where('reference_id', $reference->id)
                                            ->where('function_on_project', 'Expert')->get();

        $experts_name = $reference->contributors()->where('function_on_project', 'Expert')->get();

        $consultants = $reference->contributors()->where('function_on_project', 'Consultant')->get();

        $financings = $reference->fundings()->get();
        
        // dd($financings);

        // $external_services = ExternalService::all();
        // $external_services = $subsidiary->external_services()->get();
        $external_services = $reference->external_services()->get();
        // $internal_services = InternalService::all();
        // $internal_services = $subsidiary->internal_services()->get();
        $internal_services = $reference->internal_services()->get();
        // $domains = Domain::all();
        $domains = $subsidiary->domains()->get();
        // $expertises = Expertise::all();
        $expertises = $subsidiary->expertises()->get();
        // $categories = Category::all();
        $categories = $subsidiary->categories()->get();
        $measures = $subsidiary->measures()->get();
        $countries = Country::orderBy('name', 'asc')->get();
        $country = Country::find($reference->country);
        $zones = Zone::orderBy('name','asc')->get();
        $zone = Zone::find($reference->zone);
        if ($zone) {
            $zone_manager = Contributor::find($zone->manager);
        }
        else {
            $zone_manager = null;
        }

        $fundings = Funding::all();

        $seniors = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Senior');
        })->get();

        $exps = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Expert');
        })->get();

        $consults = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Consultant');
        })->get();

        $senior_profiles = ContributorReference::where('function_on_project', 'Senior')->distinct()->get();
        $expert_profiles = ContributorReference::where('function_on_project', 'Expert')->distinct()->get();

        $contacts = Contact::all();
        $clients = Client::all();

        $files = Storage::files('References/'.$reference->project_number);
        // dd($files);
        $user_profile = Auth::user()->profile_id;

        if (Auth::user()->username == $reference->created_by) {
            $is_creator = 1;
        }
        else {
            $is_creator = 0;
        }

        $directory = storage_path('app/Exports');
        $languages_with_template = array();

        foreach (glob($directory.'/*', GLOB_ONLYDIR) as $folder) {
            $folder_name = basename($folder);
            if ($folder_name != 'Other templates') {
                array_push($languages_with_template, $folder_name);
            }
        }

        $view = view('references.show', ['languages_with_template'=>$languages_with_template, 'is_creator'=>$is_creator, 'user_profile'=>$user_profile, 'files'=>$files, 'reference'=>$reference, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'measures'=>$measures, 'country'=>$country, 'countries'=>$countries, 'zones'=>$zones, 'zone'=>$zone, 'zone_manager'=>$zone_manager, 'measures_values'=>$measures_values, 'qualifiers_values'=>$qualifiers_values, 'linked_languages'=>$linked_languages, 'language_reference'=>$language_reference, 'client'=>$client, 'contact'=>$contact, 'staff_involved'=>$staff_involved, 'staff_name'=>$staff_name, 'experts'=>$experts, 'experts_name'=>$experts_name, 'consultants'=>$consultants, 'financings'=>$financings, 'seniors'=>$seniors, 'exps'=>$exps, 'consults'=>$consults, 'senior_profiles'=>$senior_profiles, 'expert_profiles'=>$expert_profiles, 'contacts'=>$contacts, 'clients'=>$clients, 'fundings'=>$fundings]);
        
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subsidiary = Subsidiary::find(Auth::user()->subsidiary_id);
        $reference = Reference::find($id);

        $measures_values = MeasureValues::where('reference_id', $id)->get();

        $qualifiers_values = QualifierValues::where('reference_id', $id)->get();

        // $languages = Language::all();
        $linked_languages = $reference->languages()->get();
        // $translation_languages = Language::orderBy('name', 'asc')->get();

        $linked_languages_tab = [];

        foreach ($linked_languages as $language) {
            $linked_languages_tab[] = $language->id;
        }

        // $translation_languages = Language::orderBy('name', 'asc')->whereNotIn('id', $linked_languages_tab)->get();
        $translation_languages = $subsidiary->languages()->whereNotIn('id', $linked_languages_tab)->get();
        // dd($translation_languages);
        // $languagesValues = LanguageReference::where('reference_id', $id)->get();
        $language_reference = LanguageReference::where('reference_id', $id)->get();

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
        
        // dd($financings);

        // $external_services = ExternalService::all();
        $external_services = $subsidiary->external_services()->get();
        // $internal_services = InternalService::all();
        $internal_services = $subsidiary->internal_services()->get();
        // $domains = Domain::all();
        $domains = $subsidiary->domains()->get();
        // $expertises = Expertise::all();
        $expertises = $subsidiary->expertises()->get();
        // $categories = Category::all();
        $categories = $subsidiary->categories()->get();
        $measures = $subsidiary->measures()->get();
        // $countries = Country::orderBy('name', 'asc')->get();
        $countries = Country::has('zones')->orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();

        $fundings = Funding::all();

        $seniors = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Senior');
        })->get();

        $exps = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Expert');
        })->get();

        $consults = Contributor::whereHas('references', function ($query) {
            $query->where('function_on_project', 'Consultant');
        })->get();

        $senior_profiles = ContributorReference::where('function_on_project', 'Senior')->distinct()->get();
        $expert_profiles = ContributorReference::where('function_on_project', 'Expert')->distinct()->get();

        $contacts = Contact::all();
        $clients = Client::all();

        $country_zone = CountryZone::all();
        $zone_managers = Contributor::where('profile', 'In-house')->orderBy('name', 'asc')->get();

        $files = Storage::files('References/'.$reference->project_number);

        $directory = storage_path('app/Exports');
        $languages_with_template = array();

        foreach (glob($directory.'/*', GLOB_ONLYDIR) as $folder) {
            $folder_name = basename($folder);
            if ($folder_name != 'Other templates') {
                array_push($languages_with_template, $folder_name);
            }
        }

        $view = view('references.edit', ['languages_with_template'=>$languages_with_template, 'files'=>$files, 'reference'=>$reference, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'measures'=>$measures, 'countries'=>$countries, 'zones'=>$zones, 'measures_values'=>$measures_values, 'qualifiers_values'=>$qualifiers_values, 'linked_languages'=>$linked_languages, 'language_reference'=>$language_reference, 'client'=>$client, 'contact'=>$contact, 'staff_involved'=>$staff_involved, 'staff_name'=>$staff_name, 'experts'=>$experts, 'experts_name'=>$experts_name, 'consultants'=>$consultants, 'financings'=>$financings, 'seniors'=>$seniors, 'exps'=>$exps, 'consults'=>$consults, 'senior_profiles'=>$senior_profiles, 'expert_profiles'=>$expert_profiles, 'contacts'=>$contacts, 'clients'=>$clients, 'fundings'=>$fundings, 'country_zone'=>$country_zone, 'zone_managers'=>$zone_managers, 'translation_languages'=>$translation_languages]);
        
        return $view;
    }

    public function link_translation(Request $request, $reference_id)
    {
        // dd($_POST);
        $reference = Reference::find($reference_id);

        $reference->languages()->attach($request->language);

        return redirect()->back();
    }

    public function detach_translation($reference_id, $language_id)
    {
        // dd('Here');
        $reference = Reference::find($reference_id);
        $reference->languages()->detach($language_id);

        return redirect()->back();
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
        // dd($request->linked_languages['Spanish']);
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

            // $month_start = strstr($request->start_date, '-', true);
            // $year_start = substr($request->start_date, strpos($request->start_date, '-') + 1);
            
            // $reference->start_date = $year_start.'-'.$month_start.'-01';
        $reference->start_date = $request->start_date;

            // $month_end = strstr($request->end_date, '-', true);
            // $year_end = substr($request->end_date, strpos($request->end_date, '-') + 1);

            // $reference->end_date = $year_end.'-'.$month_end.'-01';
        $reference->end_date = $request->end_date;

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

        if ($request->staff_number != '' && $request->staff_number != 0) {
            $reference->staff_number = $request->staff_number;
        }
        else {
            $reference->staff_number = null;   
        }

        if ($request->seureca_man_months != '' && $request->seureca_man_months != 0) {
            $reference->seureca_man_months = $request->seureca_man_months;
        }
        else {
            $reference->seureca_man_months = null;   
        }

        if ($request->consultants_man_months != '' && $request->consultants_man_months != 0) {
            $reference->consultants_man_months = $request->consultants_man_months;
        }
        else {
            $reference->consultants_man_months = null;   
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

        if ($request->seureca_services_cost != '' && $request->seureca_services_cost != 0) {
            $reference->seureca_services_cost = $request->seureca_services_cost;
        }
        else {
            $reference->seureca_services_cost = null;
        }

        if ($request->total_project_cost != '' && $request->total_project_cost != 0) {
            $reference->total_project_cost = $request->total_project_cost;
        }
        else {
            $reference->total_project_cost = null;
        }

        if ($request->work_cost != '' && $request->work_cost != 0) {
            $reference->work_cost = $request->work_cost;
        }
        else {
            $reference->work_cost = null;
        }

        $reference->general_comments = $request->input('general_comments');
        $reference->general_comments_fr = $request->input('general_comments_fr');

        if ($request->project_currency == 'M $') {
            $reference->currency = 'Dollars';
        }
        else {
            $reference->currency = 'Euros';   
        }
        // $reference->currency = $request->project_currency;

        if ($request->project_currency == "M $") {
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

        $reference->updated_by = Auth::user()->username;

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
        if ($request->categories) {
            foreach ($request->categories as $category) {
                foreach ($category as $key => $value) {
                    if ($value != '') {
                        $measure_in_db = Measure::where('id', $key)->first();

                        if (count($measure_in_db->units) > 1) {
                            $reference->measures()->attach($key, ['value' => $value, 'unit' => $request->units[$key]]);
                        }
                        else {
                            $reference->measures()->attach($key, ['value' => $value]);   
                        }
                    }
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

        //Detach all fundings
        $reference->fundings()->detach();

        //Attach the fundings to the reference
        
        foreach ($request->financing as $key => $f) {
            if ($f[0] != '') {
                if ($f[1] != '') {
                    $funding_in_db = Funding::where('name', $f[0])->orWhere('name_fr', $f[1])->first();
                }
                else {
                    $funding_in_db = Funding::where('name', $f[0])->first();
                }
            }
            else {
                if ($f[1] != '') {
                    $funding_in_db = Funding::where('name_fr', $f[1])->first();
                }
                else {
                    $funding_in_db = null;
                }
            }
            if ($funding_in_db) {
                if ($funding_in_db->name == '') {
                    $funding_in_db->name = $f[0];
                    $funding_in_db->save();
                }
                if ($funding_in_db->name_fr == '') {
                     $funding_in_db->name_fr = $f[1];
                     $funding_in_db->save();
                }
                $isLinked = $reference->fundings()->where('id', $funding_in_db->id)->first();
                if ($isLinked) {
                    
                }
                else {
                    $reference->fundings()->attach($funding_in_db->id);
                }
            }
            else {
                if ($f[0] != '' || $f[1] != '') {
                    $new_funding = new Funding;
                    if ($f[0] != '') {
                        $new_funding->name = $f[0];
                    }
                    if ($f[1] != '') {
                        $new_funding->name_fr = $f[1];
                    }
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
                    $reference->contributors()->attach($staff_in_db->id, ['responsability_on_project'=>$request->involved_staff_function[$key], 'responsability_on_project_fr'=>$request->involved_staff_function_fr[$key]]);
                }
                else {
                    $new_staff = new Contributor;
                    $new_staff->name = $value;

                    $new_staff->save();
                    $reference->contributors()->attach($new_staff->id, ['responsability_on_project'=>$request->involved_staff_function[$key], 'responsability_on_project_fr'=>$request->involved_staff_function_fr[$key]]);
                }
            }
            else {
                if ($request->involved_staff_function[$key] != '' || $request->involved_staff_function_fr[$key] != '') {
                    $new_link = new ContributorReference;
                    $new_link->reference_id = $reference->id;
                    $new_link->responsability_on_project = $request->involved_staff_function[$key];
                    $new_link->responsability_on_project_fr = $request->involved_staff_function_fr[$key];

                    $new_link->save();
                }
            }
        }

        //Attach the experts
        foreach ($request->experts as $key => $value) {
            if ($value != '') {
                $expert_in_db = Contributor::where('name', $value)->first();

                if ($expert_in_db) {
                    $reference->contributors()->attach($expert_in_db->id, ['responsability_on_project'=>$request->expert_functions[$key], 'responsability_on_project_fr'=>$request->expert_functions_fr[$key], 'function_on_project'=>'Expert']);
                }
                else {
                    $new_expert = new Contributor;
                    $new_expert->name = $value;

                    $new_expert->save();
                    $reference->contributors()->attach($new_expert->id, ['responsability_on_project'=>$request->expert_functions[$key], 'responsability_on_project_fr'=>$request->expert_functions_fr[$key],'function_on_project'=>'Expert']);
                }
            }
            else {
                if ($request->expert_functions[$key] != '' || $request->expert_functions_fr[$key] != '') {
                    $new_link = new ContributorReference;
                    $new_link->reference_id = $reference->id;
                    $new_link->responsability_on_project = $request->expert_functions[$key] ;
                    $new_link->responsability_on_project_fr = $request->expert_functions_fr[$key];
                    $new_link->function_on_project = 'Expert';

                    $new_link->save();
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
        $reference->languages()->detach();
        if ($request->linked_languages) {
            // $reference->languages()->detach();
            // $textareas = ['project_description', 'service_description', 'comments'];
            // foreach ($textareas as $value) {
            //     # code...
            // }

            foreach ($request->linked_languages as $key => $language) {
                $language_in_db = Language::where('name', $key)->first();

                

                $reference->languages()->attach($language_in_db->id, [
                    'project_name'=>$language['project_name'],
                    'country'=>$language['country'],
                    'location'=>$language['location'],
                    'staff'=>$language['staff'],
                    'consultants'=>$language['consultants'], 
                    'project_description'=>$language['project_description'],
                    'service_name'=>$language['service_title'],
                    'service_description'=>$language['service_description'],
                    'experts'=>$language['experts'],
                    'contact_name'=>$language['contact_name'],
                    'contact_department'=>$language['contact_department'],
                    'contact_email'=>$language['contact_email'],
                    'client'=>$language['customer_name'],
                    'customer_address'=>$language['customer_address'],
                    'financing'=>$language['funding'],
                    'general_comments'=>$language['comments'],
                ]);
            }
        }

        // return redirect()->action('ReferenceController@index');
        return redirect()->back();
    }

    public function approve($id)
    {
        $reference = Reference::find($id);
        $reference->dcom_approval = 1;
        $reference->approved_at = date('Y-m-d H:i:s');

        $reference->save();

        return redirect()->back();
    }

    public function disapprove($id)
    {
        $reference = Reference::find($id);
        $reference->dcom_approval = 0;
        $reference->approved_at = null;

        $reference->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $reference = Reference::find($id);

        $reference->external_services()->detach();
        $reference->internal_services()->detach();
        $reference->expertises()->detach();
        $reference->measures()->detach();
        $reference->qualifiers()->detach();
        $reference->languages()->detach();
        $reference->fundings()->detach();
        $reference->contributors()->detach();

        $has_folder = Storage::disk('local')->has('References/'.$reference->project_number);

        if ($has_folder) {
            Storage::deleteDirectory('References/'.$reference->project_number);
        }

        Reference::destroy($id);

        return redirect()->action('ReferenceController@index');    
    }

    public function match_page($subsidiary_id)
    {
        $fields = [
            'Project number',
            'Name of DFAC project',
            'Country',
            'Continent',
            'Zone',
            'Zone manager',
            'Location',
            'Project start date',
            'Project completion',
            'Estimated duration',
            'Name of the project',
            'Detailed description of project',
            'Title of services provided by Seureca',
            'Detailed description of service',
            'Staff involved',
            'Experts employed',
            'Total number of staff',
            'Total number man/months (Seureca)',
            'Total number man/months (Associated consultants)',
            'Name of associated consultants',
            'Contact name',
            'Contact department',
            'Contact phone',
            'Contact email',
            'Name of the client',
            'Financing',
            'Total project cost',
            'Cost of services provided by Seureca',
            'Works cost',
            'General comments / Key words'
        ];

        $view = view('references.export.match_page', ['fields'=>$fields]);
        return $view; 
    }

    //Generate word files for base language (French and english)
    public function generate_file_base($template_name, $kind_of_template, $reference_id)
    {
        $new_file = ReferenceController::generate_file_base2(null, $template_name, $kind_of_template, $reference_id);

        return response()->download($new_file)->deleteFileAfterSend(true);
    }

    //Generate word files for all languages
    public function generate_file_translations($reference_id, $language_id)
    {
        $new_file = ReferenceController::generate_file_translations_generic($reference_id, $language_id, null);

        return response()->download($new_file)->deleteFileAfterSend(true);
    }

    public function generate_file_translations_generic($reference_id, $language_id, $new_folder)
    {
        // dd($_POST);
        \PhpOffice\PhpWord\Autoloader::register();

        $language = Language::find($language_id);
        $language_reference_join = LanguageReference::where('language_id', $language_id)->where('reference_id', $reference_id)->first();
        $template_file = 'Template.docx';
        
        $template_exists = Storage::disk('local')->has('Exports/'.$language->name.'/'.$template_file);

        if ($template_exists && $language_reference_join) {
            
            $reference = Reference::find($reference_id);
            $country = Country::find($reference->country);
            $translations = $language_reference_join['attributes'];
            $template = storage_path('app/Exports/'.$language->name.'/'.$template_file);
            $current_date = date('Y-m-d_H-i-s');

            $file_name = snake_case($reference->project_number).'_'.$language->name.'_'.$current_date.'.docx';

            if ($new_folder) {
                // $new_folder = 'Exports/'.$language->name.'/Files_to_zip_'.$current_date;
                $new_file = storage_path('app/'.$new_folder.'/'.$file_name);
                //Create the temp folder in which the file will be generated
                // Storage::makeDirectory($new_folder);
            }
            else {
                $new_file = storage_path('app/Exports/'.$language->name.'/'.$file_name);
            }

            //Create file from template
            $templateProcessor = new TemplateProcessor($template);

            //Insert values in template variables
            $templateProcessor->setValue('ProjectTitle', htmlspecialchars($translations['project_name']));
            $templateProcessor->setValue('ProjectDescription', htmlspecialchars($translations['project_description']));
            $templateProcessor->setValue('ServiceDescription', htmlspecialchars($translations['service_description']));
            $templateProcessor->setValue('CustomerName', htmlspecialchars($translations['client']));
            $templateProcessor->setValue('StudyComment', htmlspecialchars($translations['general_comments']));
            $templateProcessor->setValue('Localisation', htmlspecialchars($translations['location']));
            $templateProcessor->setValue('Country', htmlspecialchars($translations['country']));
            $templateProcessor->setValue('CustomerAddress', htmlspecialchars($translations['customer_address']));
            $templateProcessor->setValue('Partners', htmlspecialchars($translations['financing']));
            $templateProcessor->setValue('SeniorProfile', htmlspecialchars($translations['staff']));
            $templateProcessor->setValue('Consultants', htmlspecialchars($translations['consultants']));

            // $templateProcessor->setValue('Localisation', htmlspecialchars($reference->location));
            $templateProcessor->setValue('NStaff', htmlspecialchars($reference->staff_number));
            $templateProcessor->setValue('NMonthMan', htmlspecialchars($reference->seureca_man_months));
            $templateProcessor->setValue('StartDate', htmlspecialchars($reference->start_date));
            $templateProcessor->setValue('EndDate', htmlspecialchars($reference->end_date));
            $templateProcessor->setValue('StudyCost', number_format($reference->seureca_services_cost));
            $templateProcessor->setValue('NStaffMonthConsultant', htmlspecialchars($reference->consultants_man_months));
            $templateProcessor->setValue('NExperts', htmlspecialchars($reference->contributors()->where('function_on_project', 'Expert')->count()));

            //Save filled file
            $templateProcessor->saveAs($new_file);
            
            //Download the file & delete it from server
            return $new_file;
        }
        else {
            // return redirect()->back();
            return null;
            // dd('The template does not exist or the reference is not translated.');
        }
    }

    public function generate_file_base_multiple(Request $request, $template_name, $kind_of_template)
    {
        // dd($_POST);

        if ($request->ids) {
            if (count($request->ids) == 1) {
                $new_file = ReferenceController::generate_file_base2(null, $template_name, $kind_of_template, $request->ids[0]);

                return response()->download($new_file)->deleteFileAfterSend(true);
            }
            else {
                $currentDate = date('Y-m-d_H-i-s');
                $folder_name = 'References_'.$currentDate;
                $new_folder = 'Exports/'.$folder_name;

                Storage::makeDirectory($new_folder);

                foreach ($request->ids as $value) {
                    $new_file = ReferenceController::generate_file_base2($new_folder, $template_name, $kind_of_template, $value);
                }

                $zip_file = ReferenceController::zip_files($folder_name);

                return response()->download(storage_path('app/Exports/'.$zip_file))->deleteFileAfterSend(true);
            }
        }
        else {
            dd('You have to select at least 1 reference.');
        }
    }

    public function generate_file_base2($folder, $template_name, $kind_of_template, $reference_id)
    {
        \PhpOffice\PhpWord\Autoloader::register();     

        $template = storage_path('app/Exports/'.$template_name.'.docx');

        $template_exists = Storage::disk('local')->has('Exports/'.$template_name.'.docx');

        if ($template_exists) {

            $reference = Reference::find($reference_id);
            $country = Country::find($reference->country);
            $subsidiary = Subsidiary::find($reference->subsidiary_id);
            $client = Client::find($reference->client);
            $current_date = date('Y-m-d_H-i-s');

            // If we are extracting multiple references
            if ($folder) {
                $new_file = storage_path('app/'.$folder.'/'.snake_case($reference->project_number).'_'.$kind_of_template.'.docx');
            }
            else {
                $new_file = storage_path('app/Exports/'.snake_case($reference->project_number).'_'.$kind_of_template.'_'.$current_date.'.docx');
            }

            //Create file from template
            $templateProcessor = new TemplateProcessor($template);

            //Insert values in template variables
            $templateProcessor->setValue('ProjectNumber', htmlspecialchars($reference->project_number));
            $templateProcessor->setValue('ProjectTitle', htmlspecialchars($reference->project_name));
            $templateProcessor->setValue('ProjectTitleFr', htmlspecialchars($reference->project_name_fr));
            if ($subsidiary) {
                $templateProcessor->setValue('Subsidiary', htmlspecialchars($subsidiary->name));
            }

            if ($country) {
                $templateProcessor->setValue('Country', htmlspecialchars($country->name));
            }
            $templateProcessor->setValue('Location', htmlspecialchars($reference->location));
            $templateProcessor->setValue('TotalCost', htmlspecialchars(number_format($reference->total_project_cost, 2)));
            $templateProcessor->setValue('WorkCost', htmlspecialchars(number_format($reference->work_cost, 2)));
            $templateProcessor->setValue('ServiceCost', htmlspecialchars(number_format($reference->seureca_services_cost, 2)));
            $templateProcessor->setValue('Comments', htmlspecialchars($reference->general_comments));
            if ($reference->seureca_services_cost != 0 && $reference->total_project_cost != 0) {
                $service_proportion = (($reference->seureca_services_cost)*100)/$reference->total_project_cost;
                $service_proportion = number_format($service_proportion, 2, '.', ',');
                $templateProcessor->setValue('ServiceProportion', htmlspecialchars($service_proportion));
            }
            else {
                $templateProcessor->setValue('ServiceProportion', '');
            }
            $templateProcessor->setValue('StaffMonths', htmlspecialchars($reference->seureca_man_months));
            $templateProcessor->setValue('NbStaff', htmlspecialchars($reference->staff_number));
            if ($client) {
                $templateProcessor->setValue('Customer', htmlspecialchars($client->name));
                $templateProcessor->setValue('CustomerFr', htmlspecialchars($client->name_fr));
                $templateProcessor->setValue('CustomerAddress', htmlspecialchars($client->address));
            }

            if ($reference->fundings()->count() > 0) {
                $f = '';
                $fr = '';
                foreach ($reference->fundings as $key => $funding) {
                    $f = $f.'-'.$funding->name;
                    $fr = $fr.'-'.$funding->name_fr;
                }
                $templateProcessor->setValue('Funding', htmlspecialchars($f));
                $templateProcessor->setValue('FundingFr', htmlspecialchars($fr));
            }
            else {
                $templateProcessor->setValue('Funding', '');
                $templateProcessor->setValue('FundingFr', '');
            }

            $templateProcessor->setValue('StartDate', htmlspecialchars($reference->start_date));
            $templateProcessor->setValue('EndDate', htmlspecialchars($reference->end_date));

            // $templateProcessor->setValue('Consultant', htmlspecialchars());
            if ($reference->contributors()->where('function_on_project', 'Consultant')->count() > 0) {
                $c = '';
                foreach ($reference->contributors()->where('function_on_project', 'Consultant')->get() as $key => $consultant) {
                    $c = $c.'-'.$consultant->name;
                }
                $templateProcessor->setValue('Consultant', $c);
            }
            else {
                $templateProcessor->setValue('Consultant', '');
            }

            $templateProcessor->setValue('ConsultantManMonths', htmlspecialchars($reference->consultants_man_months));
            $templateProcessor->setValue('ProjectDescription', htmlspecialchars($reference->project_description));
            $templateProcessor->setValue('ProjectDescriptionFr', htmlspecialchars($reference->project_description_fr));
            $templateProcessor->setValue('ServiceDescription', htmlspecialchars($reference->service_description));
            $templateProcessor->setValue('ServiceDescriptionFr', htmlspecialchars($reference->service_description_fr));

            if ($reference->contributors()->where('function_on_project', 'Senior')->count() > 0) {
                $s = '';
                foreach ($reference->contributors()->where('function_on_project', 'Senior')->get() as $key => $senior) {
                    $senior_reference = ContributorReference::where('reference_id', $reference->id)->where('contributor_id', $senior->id)->first();
                    if ($key == 0) {
                        $s = $senior->name.' -> '.$senior_reference->responsability_on_project.' / ';
                    }
                    else {
                        $s = $s.$senior->name.' -> '.$senior_reference->responsability_on_project;
                    }
                }
                $templateProcessor->setValue('SeniorStaff', $s);
            }
            else {
                $templateProcessor->setValue('SeniorStaff', '');   
            }



            //Save filled file
            $templateProcessor->saveAs($new_file);

            return $new_file;

        }
        else {
            dd('The template does not exist.');
        }
    }

    public function zip_files($folder) {

        // Here we choose the folder which will be used.       
        $dirName = storage_path('app/Exports/'.$folder);

        // Choose a name for the archive.
        $zipFileName = $folder.'.zip';    

        // Create "MyCoolName.zip" file in public directory of project.
        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/Exports/').$zipFileName, ZipArchive::CREATE) === TRUE) {
            // Copy all the files from the folder and place them in the archive.
            foreach (glob($dirName . '/*') as $fileName) {
                $file = basename($fileName);                
                $zip->addFile($fileName, $file);
            }                       
            $zip->close();

                $headers = array(
                    'Content-Type' => 'application/octet-stream',
                );

                File::cleanDirectory($dirName);
                Storage::deleteDirectory('Exports/'.$folder);

                return $zipFileName;
            // Download .zip file.        
            // return response()->download(storage_path('app/Exports') . '/' . $zipFileName, $zipFileName, $headers);
        } 
        else {
            echo 'failed';
        }
    }

    public function generate_file_translations_multiple(Request $request)
    {
        // dd($_POST);
        if ($request->ids) {
            if (count($request->ids) == 1) {
                // dd($request->ids[0]);
                $new_file = ReferenceController::generate_file_translations_generic($request->ids[0], $request->language_id, null);

                if ($new_file != null) {
                    return response()->download($new_file)->deleteFileAfterSend(true);
                }
                else {
                    return redirect()->back();
                }
            }
            else {
                $language = Language::find($request->language_id);
                $currentDate = date('Y-m-d_H-i-s');
                $folder_name = 'References_'.$currentDate;
                $new_folder = 'Exports/'.$language->name.'/'.$folder_name;

                Storage::makeDirectory($new_folder);

                foreach ($request->ids as $value) {
                    // ReferenceController::generate_file_translations2($new_folder, $value, $language_id);
                    $new_file = ReferenceController::generate_file_translations_generic($value, $request->language_id, $new_folder);

                }

                $zip_file = ReferenceController::zip_files($language->name.'/'.$folder_name);

                return response()->download(storage_path('app/Exports/'.$zip_file))->deleteFileAfterSend(true);
            }        
        }
        else {
            dd('You have to select at least 1 reference.');
        }
    }

    public function upload_file(Request $request, $reference_id)
    {
        $reference = Reference::find($reference_id);
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        // dd($file_name);

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $request->file('file')->move(storage_path('app/References/'.$reference->project_number), $file_name);
            }
            else {
                dd('File not valid');
            }
        }
        else {
            dd('No file');
        }

        return redirect()->back();
    }

    public function download_file(Request $request, $reference_id)
    {
        // dd($_POST);
        $reference = Reference::find($reference_id);

        return response()->download(storage_path('app/References/'.$reference->project_number.'/'.$request->file));
    }

    public function delete_file(Request $request, $reference_id)
    {
        // dd($_POST);
        $reference = Reference::find($reference_id);

        Storage::delete('References/'.$reference->project_number.'/'.$request->file);

        return redirect()->back();
    }

    public function import_page()
    {
        $view = view('references.import.index', []);
        return $view;
    }

    public function upload_references(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $has_folder = Storage::disk('local')->has('Imports');

        if ($has_folder == false) {
            Storage::makeDirectory('Imports');
        }

        $destination_path = storage_path('app/Imports/');

        if ($request->hasFile('file')) {
            if ($file->isValid()) {
                $file->move($destination_path, 'reference_import.xls');

                Excel::load('reference_import.xls', function($reader) {
                    // reader methods
                });
            }
            else {
                dd('File not valid');
            }
        }
        else {
            dd('No file');
        }

        return redirect()->back();
    }
}
