<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EditCompanyRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Ledger\Repositories\Company\CompanyInterface;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\DeleteCompanyRequest;
use App\Http\Requests\Company\IndexCompanyRequest;
use App\Http\Requests\Company\ShowCompanyRequest;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

class CompnayController extends Controller
{
    private $company;
    public function __construct(CompanyInterface $company){
        $this->company = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCompanyRequest $request)
    {
        try{
            $companies = $this->company->getAllCompany();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('compnay.index')->with('danger', $e->getMessage());
        }

        return view('admin.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCompanyRequest $request)
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        try{
                $companies = $this->company->storeCompany($request);
        } catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->route('company.index')->with('danger', $e->getMessage());
        }
        if(!empty($request->edit))
        {
            Toastr::success(''.$request->input('name').' Has Been Updated');
        }else{
            Toastr::success("New Company  ".$request->input('name')." Has Been Created");

        }
        return redirect()->route('company.index')->with('danger', "created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,ShowCompanyRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id ,EditCompanyRequest $request)
    {
        try{
            $companies = $this->company->editCompany($id);
        } catch(\Exception $e){
            return redirect()->route('company.index')->with('danger', $e->getMessage());
        }
        return view('admin.company.edit',compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeleteCompanyRequest $request)
    {
        try{
            $delete_country = $this->company->deleteCompany($id);
        }catch(\Exception $e){
            return redirect()->route('company.index')->with('danger', $e->getMessage());
        }
        Toastr::Warning('Company Successfully Deleted :)','Success');
        return redirect()->route('company.index');
    }
    public function searchCountry($keyword=null)
    {
        $countries = $this->company->searchCountry($keyword);
        $countryArray=[];
        foreach ($countries as $countrykey=>$country){
            $countryArray[$countrykey]['id']=$country->id;
            $countryArray[$countrykey]['text']=$country->country_name;
        }
        return $countryArray;
    }

    public function searchState($keyword=null,Request $request)
    {
        $states = $this->company->searchState($keyword,$request);
        $stateArray=[];
        foreach ($states as $stateykey=>$state){
            $stateArray[$stateykey]['id']=$state->id;
            $stateArray[$stateykey]['text']=$state->state_name;
        }
        return $stateArray;
    }

    public function searchCity($keyword=null,Request $request)
    {
        $cities = $this->company->searchCity($keyword,$request);
        $cityArray=[];
        foreach ($cities as $citykey=>$city){
            $cityArray[$citykey]['id']=$city->id;
            $cityArray[$citykey]['text']=$city->city_name;
        }
        return $cityArray;
    }
    public function searchSubCompany($keyword=null,Request $request)
    {
        $subcompanies = $this->company->searchSubCompany($keyword,$request);
        $subcompanyArray = [];
        foreach ($subcompanies as $subcompanykey=>$subcompany){
            $subcompanyArray[$subcompanykey]['id']=$subcompany->id;
            $subcompanyArray[$subcompanykey]['text']=$subcompany->name;
        }
        return $subcompanyArray;
    }

}
