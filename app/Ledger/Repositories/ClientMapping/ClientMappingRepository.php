<?php

namespace App\Ledger\Repositories\ClientMapping;

use App\Admin\Client;
use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\LedgerEntry;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class ClientMappingRepository implements ClientMappingInterface
{
   
    public function getAllSubCompany()
    {
        $subcompanies = SubCompany::all();
        return $subcompanies;
    }
    // public function getAllSubClient()
    // {
    //     $clients = Client::all();
    //     return $clients;
    // }

    // public function editSubCompanyStock($id)
    // {
    //     $subcompanystock=CompanyStock::find($id);
    //     return $subcompanystock;
    // }

    // public function storeSubCompanyStock($request)
    // {
    //     if(!empty($request->edit))
    //     {
    //         $subcompanystock=CompanyStock::find($request->edit);
    //     }
    //     else
    //     {
    //         $subcompanystock=new CompanyStock();
    //     }
    //     $subcompanystock->subcompany_id = $request->subcompanyname;
    //     $subcompanystock->opening_balance = $request->opening_balance;
    //     $subcompanystock->save();
    //     return $subcompanystock;
    // }
    
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
