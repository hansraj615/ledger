<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use App\Ledger\Repositories\Company\CompanyInterface;
use Brian2694\Toastr\Facades\Toastr;

class SubCompnayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $subcompany;
    private $company;

    public function __construct(SubCompanyInterface $subcompany,CompanyInterface $company){
        $this->subcompany = $subcompany;
        $this->company = $company;
    }
    public function index()
    {
        try{
            $subcompanies = $this->subcompany->getAllSubCompany();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('subcompnay.index')->with('danger', $e->getMessage());
        }

        return view('admin.subcompany.index',compact('subcompanies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $companies = $this->company->getAllCompany();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('subcompnay.index')->with('danger', $e->getMessage());
        }
        return view('admin.subcompany.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
          try{
            $subcompanies = $this->subcompany->storeSubCompany($request);
           
    } catch(\Exception $e){
          return redirect()->route('subcompany.index')->with('danger', $e->getMessage());
    }
    if(!empty($request->edit))
    {
        Toastr::success(''.$request->input('name').' Has Been Updated');
    }else{
        Toastr::success("New SubCompany  ".$request->input('name')." Has Been Created");

    }
    return redirect()->route('subcompany.index')->with('danger', "created");
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
        //
        try{
            $subcompanies = $this->subcompany->editSubCompany($id);
        } catch(\Exception $e){
            return redirect()->route('subcompany.index')->with('danger', $e->getMessage());
        }
        return view('admin.subcompany.edit',compact('subcompanies'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $delete_country = $this->subcompany->deleteSubCompany($id);
        }catch(\Exception $e){
            return redirect()->route('subcompany.index')->with('danger', $e->getMessage());
        }
        Toastr::Warning('SubCompany Successfully Deleted :)','Success');
        return redirect()->route('subcompany.index');
    }

    public function searchCountry($keyword=null)
    {
        $countries = $this->subcompany->searchCountry($keyword);
        $countryArray=[];
        foreach ($countries as $countrykey=>$country){
            $countryArray[$countrykey]['id']=$country->id;
            $countryArray[$countrykey]['text']=$country->country_name;
        }
        return $countryArray;
    }

    public function searchState($keyword=null,Request $request)
    {
        $states = $this->subcompany->searchState($keyword,$request);
        $stateArray=[];
        foreach ($states as $stateykey=>$state){
            $stateArray[$stateykey]['id']=$state->id;
            $stateArray[$stateykey]['text']=$state->state_name;
        }
        return $stateArray;
    }

    public function searchCity($keyword=null,Request $request)
    {
        $cities = $this->subcompany->searchCity($keyword,$request);
        $cityArray=[];
        foreach ($cities as $citykey=>$city){
            $cityArray[$citykey]['id']=$city->id;
            $cityArray[$citykey]['text']=$city->city_name;
        }
        return $cityArray;
    }

}
