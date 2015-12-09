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

        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients]);
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

        $languages = Language::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();
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
        $view = view('references.create', ['languages'=>$languages, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'zones'=>$zones, 'seniors'=>$seniors, 'experts'=>$experts, 'consultants'=>$consultants]);
        return $view;
    }

    public function basic_search(Request $request)
    {
        // dd($_POST);
        $references = Reference::where('project_number', 'LIKE', '%'.$request->input('search_input').'%')
                        ->orWhere('dfac_name', 'LIKE', '%'.$request->input('search_input').'%')
                        ->orWhere('start_date', 'LIKE', '%'.$request->input('search_input').'%')
                        ->orWhere('end_date', 'LIKE', '%'.$request->input('search_input').'%')
                        // ->orWhere('client', 'LIKE', '%'.$request->input('search_input').'%')
                        // ->orWhere('start_date', 'LIKE', '%'.$request->input('search_input').'%')
                        ->paginate(4);
        $countries = Country::all();
        $clients = Client::all();
        $references->setPath('basic_search');
        $view = view('references.index', ['references'=>$references, 'countries'=>$countries, 'clients'=>$clients]);
        return $view;
    }

    public function search()
    {
        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();

        $view = view('references.search', ['zones'=>$zones, 'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries]);
        return $view;
    }

    public function results(Request $request)
    {
        // dd($_GET);


        $references = Reference::where('project_number', 'LIKE', '%'.$request->input('keyword').'%')
                                    ->orWhere('start_date', 'LIKE', '%'.$request->input('keyword').'%');
        if ($request->input('country')) {
            // $references->where(function ($query) {
            //     $query->where('country', 240)
            //             ->orWhere('country', 241);
            // });
            foreach ($request->input('country') as $key => $value) {
                $country = Country::where('name', $value)->first();
                $references->where('country', $country->id);
            }
        }
        
        $references = $references->paginate(1);
        
        // $references = Reference::where('project_number', 'LIKE', '%'.$request->input('keyword').'%')
        //                             ->where('country', 240)->paginate(1);

        $zones = Zone::all();
        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $countries = Country::all();
        $clients = Client::all();

        // $references->setPath('results');
        $view = view('references.results', ['references'=>$references, 'zones'=>$zones,'external_services'=>$external_services, 'internal_services'=>$internal_services, 'domains'=>$domains, 'countries'=>$countries, 'clients'=>$clients]);
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
        foreach ($request->input('languages') as $key => $language) {
            $language_in_db = Language::where('name', $key)->first();

            $reference->languages()->attach($language_in_db->id, ['project_name'=>$language[0], 'project_description'=>$language[1], 'service_name'=>$language[2], 'service_description'=>$language[3], 'experts'=>$language[4], 'contact_name'=>$language[5], 'contact_department'=>$language[6], 'contact_email'=>$language[7], 'client'=>$language[8], 'financing'=>$language[9], 'general_comments'=>$language[10]]);
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

        // dd($languagesValues);


        // $internal_services = Service::where('subsidiary','Seureca')
        //                                 ->where('service_type', 'internal')
        //                                 ->first()
        //                                 ->subServices()->get();
        // $external_services = Service::where('subsidiary','Seureca')
        //                                 ->where('service_type', 'external')
        //                                 ->first()
        //                                 ->subServices()->get();

        $external_services = ExternalService::all();
        $internal_services = InternalService::all();
        $domains = Domain::all();
        $expertises = Expertise::all();
        $categories = Category::all();
        $countries = Country::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name','asc')->get();

        $view = view('references.edit', ['reference'=>$reference, 'internal_services'=>$internal_services, 'external_services'=>$external_services, 'domains'=>$domains, 'expertises'=>$expertises, 'categories'=>$categories, 'countries'=>$countries, 'zones'=>$zones, 'measures_values'=>$measures_values, 'qualifiers_values'=>$qualifiers_values, 'languages'=>$languages, 'languagesValues'=>$languagesValues]);
        
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

        if ($request->input('zone') != "") {
            $reference->zone = $request->input('zone');
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
        }

        Reference::destroy($ids);

        return redirect()->action('ReferenceController@index');
    }
}
