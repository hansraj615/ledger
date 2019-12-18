<?php

namespace App\Ledger\Repositories\ClientMapping;

use App\Admin\Client;
use App\Models\Country;
use App\Models\City;
use App\Models\ClientMapping;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\LedgerEntry;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class ClientMappingRepository implements ClientMappingInterface
{
   
    public function getAllMapping()
    {
        $clients = ClientMapping::all();
        return $clients;
    }
   
    public function storeClientMapping($request)
    {
        // if(!empty($request->edit))
        // {
        //     $subcompanystock=CompanyStock::find($request->edit);
        // }
        // else
        // {
        //     $subcompanystock=new CompanyStock();
        // }
       
       $client_ids = $request->clientname;
       foreach($client_ids as $client_id)
       {
        $clientmapping=new ClientMapping();
        $clientmapping->subcompany_id = $request->subcompanyname;
        $clientmapping->client_id = $client_id;
        $clientmapping->save();
        
       }
       return $clientmapping;
        
    }

    public function searchSubClient($keyword = null) 
    {
        return  $clint_name =ClientMapping::where('subcompany_id', '=', $keyword)->select('client_id')->get();
    }
    
    // public function getAllOpening()
    // {
    //     $subcompanystock = CompanyStock::pluck('subcompany_id');
    //     // dd( $subcompanystock->toArray());
    //     $subcompany_name = SubCompany::select('id','name')->whereNotIn('id',$subcompanystock)->get();
    //     return $subcompany_name;
    // }

    // public function deleteSubCompanyStock($id)
    // {
    //     $companystockid = CompanyStock::find($id);
    //     $companystockid->delete();
    //     return $companystockid;

    // }

   
}
