<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Client\ClientInterface;
use Brian2694\Toastr\Facades\Toastr;

class ClientController extends Controller
{

     private $client;
    public function __construct(ClientInterface $client){
        $this->client = $client;
    }

    public function index()
    {
        try
        {
            $clients = $this->client->getClient();
        }
        catch(\Exception $e)
        {
             Toastr::danger($e->getMessage(),'Danger');
            return redirect()->route('client.index')->with('danger',$e->getMessage());
        }
        return view('admin.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
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
            $clients = $this->client->storeClient($request);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->route('client.index')->with('danger',$e->getMessage());
        }

        if(!empty($request->edit))
        {
            Toastr::success(''.$request->input('name').' Has been Updated');
        }
        else
        {
            Toastr::success('New Company '.$request->input('name').' Has been Created');
        }
        return redirect()->route('client.index')->with('danger','created');
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
        try{
            $clients = $this->client->editClient($id);
        }
        catch(\Exception $e)
        {
            return redirect()->route('client.index')->with('danger',$e->getMessage());
        }
        return view('admin.client.edit',compact('clients'));
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
        try{
            $delete_client = $this->client->deleteClient($id);
        }catch(\Exception $e){
            return redirect()->route('client.index')->with('error', $e->getMessage());
        }
        Toastr::Warning('Client Successfully Deleted :)','Success');
        return redirect()->route('client.index');
    }

    public function searchCountry($keyword=null)
    {
        $countries = $this->client->searchCountry($keyword);
        $countryArray=[];
        foreach ($countries as $countrykey=>$country){
            $countryArray[$countrykey]['id']=$country->id;
            $countryArray[$countrykey]['text']=$country->country_name;
        }
        return $countryArray;
    }

    public function searchState($keyword=null,Request $request)
    {
        $states = $this->client->searchState($keyword,$request);
        $stateArray=[];
        foreach ($states as $stateykey=>$state){
            $stateArray[$stateykey]['id']=$state->id;
            $stateArray[$stateykey]['text']=$state->state_name;
        }
        return $stateArray;
    }

    public function searchCity($keyword=null,Request $request)
    {
        $cities = $this->client->searchCity($keyword,$request);
        $cityArray=[];
        foreach ($cities as $citykey=>$city){
            $cityArray[$citykey]['id']=$city->id;
            $cityArray[$citykey]['text']=$city->city_name;
        }
        return $cityArray;
    }

}
