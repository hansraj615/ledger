<?php

namespace App\Ledger\Repositories\Company;

use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

class CompanyRepository implements CompanyInterface
{

    public function getAllCompany()
    {
        $companies = Company::all();
        $company_details = [];
        foreach($companies as $company){
        $countries_name =Country::where('id',$company->country)->select('country_name','country_code')->first();
        $cities_name =City::where('id',$company->city)->select('city_name')->first();
        $states_name =State::where('id',$company->state)->select('state_name')->first();
        $company->city_name = $cities_name->city_name;
        $company->state_name = $states_name->state_name;
        $company->country_name = $countries_name->country_name;
        $company->country_code = $countries_name->country_code;
        $company_details[] = $company;
        }
        return $company_details;
    }

    public function storeCompany($request)
    {

        if(!empty($request->edit))
        {
            $companies =  Company::find($request->edit);
        }else{
        $companies = new Company();
        }
        $companies->name = $request->name;
        $companies->phone_no = $request->phone_number;
        $companies->mobile_no = $request->mobile_number;
        $companies->email = $request->email;
        $companies->country = $request->country_name;
        $companies->state = $request->state_name;
        $companies->city = $request->city_name;
        $companies->pincode = $request->pincode;
        $companies->address = $request->address;
        $companies->save();

        return $companies;

    }

    public function editCompany($id)
    {
        $company = Company::find($id);
        $company_details = [];
        $countries_name =Country::where('id',$company->country)->select('country_name')->first();
        $cities_name =City::where('id',$company->city)->select('city_name')->first();
        $states_name =State::where('id',$company->state)->select('state_name')->first();
        $company->city_name = $cities_name->city_name;
        $company->state_name = $states_name->state_name;
        $company->country_name = $countries_name->country_name;
        return $company;
    }

    public function deleteCompany($id)
    {
        $album=Company::find($id);
        $album->delete();
        return $album;
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

}
