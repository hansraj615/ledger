<?php

namespace App\Ledger\Repositories\Client;

use App\Models\Client;
use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class ClientRepository implements ClientInterface
{
    public function getClient()
    {
        // $client = Client::get();
        // return $client;
        $clients = Client::all();
        $client_details = [];
        foreach($clients as $client){
        $countries_name =Country::where('id',$client->country)->select('country_name','country_code')->first();
        $cities_name =City::where('id',$client->city)->select('city_name')->first();
        $states_name =State::where('id',$client->state)->select('state_name')->first();
        $client->city_name = $cities_name->city_name;
        $client->state_name = $states_name->state_name;
        $client->country_name = $countries_name->country_name;
        $client->country_code = $countries_name->country_code;
        
        $client_details[] = $client;
        }
        //dd($client_details);
        return $client_details;
    }
     public function storeClient($request)
    {
        if(!empty($request->edit))
        {
            $client=Client::find($request->edit);
        }
        else
        {
            $client=new Client();
        }
        $client->name = $request->name;
        $client->phone_no = $request->phone_number;
        $client->mobile_no = $request->mobile_number;
        $client->email = $request->email;
        $client->country = $request->country_name;
        $client->state = $request->state_name;
        $client->city = $request->city_name;
        $client->pincode = $request->pincode;
        $client->address = $request->address;
       //dd($client);
        $client->save();

        return $client;
    }

    public function editClient($id)
    {
        $client = Client::find($id);
        $client_details = [];
        $subcountries_name =Country::where('id',$client->country)->select('country_name')->first();
        $cities_name =City::where('id',$client->city)->select('city_name')->first();
        $states_name =State::where('id',$client->state)->select('state_name')->first();
        $client->city_name = $cities_name->city_name;
        $client->state_name = $states_name->state_name;
        $client->country_name = $subcountries_name->country_name;
        return $client;
    }

   
    
    // public function getAllOpening()
    // {
    //     $subcompanystock = CompanyStock::pluck('subcompany_id');
    //     // dd( $subcompanystock->toArray());
    //     $subcompany_name = SubCompany::select('id','name')->whereNotIn('id',$subcompanystock)->get();
    //     return $subcompany_name;
    // }

    public function deleteClient($id)
    {
        $clientid = Client::find($id);
        $clientid->delete();
        return $clientid;

    }

    public function searchCountry($keyword = null)
    {
        return  $countries_name =Country::where('country_name', 'like', '%'.$keyword.'%')->select('id', 'country_name')->limit(10)->get();
    }

    public function searchState($keyword = null,$request)
    {
        return  $states_name =State::where('country_id',$request->country_id)->where('state_name', 'like', '%'.$request->q.'%')->select('id', 'state_name')->get();
    }

    public function searchCity($keyword = null,$request)
    {
        return  $states_name =City::where('state_id',$request->state_id)->where('city_name', 'like', '%'.$request->q.'%')->select('id', 'city_name')->get();
    }

    // public function getCompany()
    // {
    //     $company_name = Company::select('id','name')->get();
    //     return $company_name;
    // }
}
