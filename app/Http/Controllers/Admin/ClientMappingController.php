<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\ClientMapping\ClientMappingInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use Brian2694\Toastr\Facades\Toastr;

class ClientMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $clientmapping;
    private $subcompany;
    private $client;

    public function __construct(ClientMappingInterface $clientmapping,SubCompanyInterface $subcompany,ClientInterface $client)
    {
        
        $this->subcompany=$subcompany;
        $this->client=$client;
        $this->clientmapping=$clientmapping;
    }
    public function index()
    {
        try{
            $clients=$this->clientmapping->getAllMapping();
        }catch(\Exception $e)
        {
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('admin.clientmapping.index');
        }
        return view('admin.clientmapping.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $subcompanies = $this->subcompany->getAllSubCompany();
            $clients = $this->client->getClient();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('ledger.index')->with('danger', $e->getMessage());
        }
        return view('admin.clientmapping.create',compact('subcompanies','clients'));
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
            $clients=$this->clientmapping->storeClientMapping($request);
        }
        catch(\Exception $e)
        {
           dd($e->getMessage());
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('admin.clientmapping.create');
        }
        return redirect()->route('admin.clientmapping.index');
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
        try
        {
            $subcompanies = $this->subcompany->getAllSubCompany();
            $clients = $this->client->getClient();
            $clientmappingid=$this->clientmapping->editClientMapping($id);
        }
        catch(\Exception $e)
        {
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect('admin.clientmapping.index');
        }
        return view('admin.clientmapping.edit',compact('clientmappingid','subcompanies','clients'));
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
            $delete_clientmapping = $this->clientmapping->deleteClientMapping($id);
        }catch(\Exception $e){
            return redirect()->route('admin.clientmapping.index')->with('danger', $e->getMessage());
        }
        Toastr::Warning('CLientMapping Successfully Deleted :)','Success');
        return redirect()->route('admin.clientmapping.index');
    }
}
