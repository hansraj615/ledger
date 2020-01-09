<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\ClientMapping\ClientMappingInterface;
use App\Ledger\Repositories\LedgerEntry\LedgerEntryInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Client;
use App\Models\SubCompany;

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
    public function index(Request $request)
    {
        try{
            $subcompany = \App\Traits\CommonTrait::getUserSubCompanyId();
            $subcompanies = SubCompany::select('id','name')->where('id',$subcompany)->get();
            $ledger = $this->ledger->getAllLedger($subcompany);
        } catch(\Exception $e){
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('ledger.index');
        }

        return view('admin.ledgerentry.index',compact('ledger','subcompanies'));
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
        try{
            $ledgerentries = $this->ledger->storeLedgerEntry($request);

    } catch(\Exception $e){
        dd($e->getMessage());
        return redirect()->route('admin.ledger.create')->with('danger', $e->getMessage());
    }
    if(!empty($request->edit))
    {
        Toastr::success(''.$request->input('name').' Has Been Updated');
    }else{
        Toastr::success("New Entry  Has Been Added");

    }
    return redirect()->route('admin.ledger.create');
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
        $clientmappingdetailsArray=[];
        foreach($clients as $keys=>$clintmappingdetail){
            $clientArray=[];
            $clientmappingids = explode(',',$clintmappingdetail->client_id);
            foreach($clientmappingids as $key => $clientmappingid){
            $Client = Client::where('id',$clientmappingid)->first();
            $client_name = $Client->name;
            $client_id = $Client->id;
            $clientArray[$key]['id']=$client_id;
            $clientArray[$key]['text']=$client_name;
        }
        return $clientArray;

        }
    }
}
