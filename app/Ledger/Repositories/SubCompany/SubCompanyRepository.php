<?php

namespace App\Ledger\Repositories\SubCompany;

use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class SubCompanyRepository implements SubCompanyInterface
{

    public function getAllSubCompany()
    {
        $subcompanies = SubCompany::all();
        $subcompany_details = [];
        foreach($subcompanies as $subcompany){
        $countries_name =Country::where('id',$subcompany->country)->select('country_name','country_code')->first();
        $cities_name =City::where('id',$subcompany->city)->select('city_name')->first();
        $states_name =State::where('id',$subcompany->state)->select('state_name')->first();
        $subcompany->city_name = $cities_name->city_name;
        $subcompany->state_name = $states_name->state_name;
        $subcompany->country_name = $countries_name->country_name;
        $subcompany->country_code = $countries_name->country_code;
        $subcompany_details[] = $subcompany;
        }
        return $subcompany_details;
    }
    public function editSubCompany($id)
    {
        $subcompany = SubCompany::find($id);
        $subcompany_details = [];
        $subcountries_name =Country::where('id',$subcompany->country)->select('country_name')->first();
        $cities_name =City::where('id',$subcompany->city)->select('city_name')->first();
        $states_name =State::where('id',$subcompany->state)->select('state_name')->first();
        $subcompany->city_name = $cities_name->city_name;
        $subcompany->state_name = $states_name->state_name;
        $subcompany->country_name = $subcountries_name->country_name;
        return $subcompany;
    }

    public function storeSubCompany($request)
    {
        // dd($request->all());
        if(!empty($request->edit))
        {
            $subcompanies =  SubCompany::find($request->edit);
        }else{

        $subcompanies = new SubCompany();
        }
        $subcompanies->company_id = $request->companyname;
        $subcompanies->name = $request->name;
        $subcompanies->phone_no = $request->phone_number;
        $subcompanies->mobile_no = $request->mobile_number;
        $subcompanies->email = $request->email;
        $subcompanies->country = $request->country_name;
        $subcompanies->state = $request->state_name;
        $subcompanies->city = $request->city_name;
        $subcompanies->pincode = $request->pincode;
        $subcompanies->address = $request->address;
        // dd($subcompanies);
        $subcompanies->save();

        return $subcompanies;

    }


    public function deleteSubCompany($id)
    {
        $album=SubCompany::find($id);
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

    public function getCompany()
    {
        $company_name = Company::select('id','name')->get();
        return $company_name;
    }
}
