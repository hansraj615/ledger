<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\LedgerEntry\ClientMappingInterface;
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
        //
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
        //
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
    }
}
