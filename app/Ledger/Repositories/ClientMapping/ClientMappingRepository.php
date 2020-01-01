<?php

namespace App\Ledger\Repositories\ClientMapping;


use App\Models\Country;
use App\Models\City;
use App\Models\Client;
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
        $clientmappingdetailsArray = [];
        $clintmappingdetails = ClientMapping::all();
        foreach($clintmappingdetails as $keys=>$clintmappingdetail){
        $clientmappingids = explode(',',$clintmappingdetail->client_id);
        $client_name = [];
        foreach($clientmappingids as $key => $clientmappingid){
        $Client = Client::where('id',$clientmappingid)->first();
        $client_name[] = $Client->name;
        }
        $clintmappingdetail->client_name = implode(' , ',$client_name);
        $clientmappingdetailsArray[] = $clintmappingdetail;
        }
        return  $clientmappingdetailsArray;
    }

    public function storeClientMapping($request)
    {

        if(!empty($request->edit))
        {
            $clientmapping=ClientMapping::find($request->edit);
        }
        else
        {
            $clientmapping=new ClientMapping();
        }
        $clientmapping->subcompany_id = $request->subcompanyname;
        $clientmapping->client_id =implode(",",$request->clientname);
        $clientmapping->save();
        return $clientmapping;
    }

    public function searchSubClient($keyword = null)
    {
        return  $clint_name =ClientMapping::where('subcompany_id', '=', $keyword)->select('client_id')->get();
    }
    public function editClientMapping($id)
    {
        $clientmappingid=ClientMapping::find($id);
        return $clientmappingid;
    }
    public function deleteClientMapping($id)
    {
        $clientmappingid = ClientMapping::find($id);
        $clientmappingid->delete();
        return $clientmappingid;

    }

}
