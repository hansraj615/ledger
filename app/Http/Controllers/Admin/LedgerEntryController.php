<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\ClientMapping\ClientMappingInterface;
use App\Ledger\Repositories\LedgerEntry\LedgerEntryInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use Brian2694\Toastr\Facades\Toastr;

class LedgerEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $ledger;
     private $subcompany;
     private $client;
     private $clientmapping;
     
     public function __construct(LedgerEntryInterface $ledger,SubCompanyInterface $subcompany,ClientInterface $client,ClientMappingInterface $clientmapping)
     {
         $this->ledger=$ledger;
         $this->subcompany=$subcompany;
         $this->client=$client;
         $this->clientmapping=$clientmapping;
     }
    public function index()
    {
        try{
            $ledger = $this->ledger->getAllLedger();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('ledger.index')->with('danger', $e->getMessage());
        }

        return view('admin.ledgerentry.index',compact('ledger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $subcompanies = $this->ledger->getAllClientSubCompany();
            $clients = $this->ledger->getAllSubClient();

        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('ledger.index')->with('danger', $e->getMessage());
        }
        return view('admin.ledgerentry.create',compact('subcompanies','clients'));
       
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

    public function SearchClient($keyword=null)
    {
        $clients = $this->clientmapping->searchSubClient($keyword);
        $clientArray=[];
        foreach ($clients as $clientkey=>$client){
             $clientArray[$clientkey]['id']=$client->client_id;
            $clientArray[$clientkey]['text']=$client->client->name;
        }
        return $clientArray;
    }
}
