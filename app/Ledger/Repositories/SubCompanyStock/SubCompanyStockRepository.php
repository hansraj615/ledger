<?php

namespace App\Ledger\Repositories\SubCompanyStock;

use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class SubCompanyStockRepository implements SubCompanyStockInterface
{
    public function getSubComanyStock()
    {
        $subcompany_id = \App\Traits\CommonTrait::getUserSubCompanyId();
        $subcompanystock = CompanyStock::where('subcompany_id',$subcompany_id)->get();
        return $subcompanystock;
    }

    public function editSubCompanyStock($id)
    {
        $subcompanystock=CompanyStock::find($id);
        return $subcompanystock;
    }

    public function storeSubCompanyStock($request)
    {
        if(!empty($request->edit))
        {
            $subcompanystock=CompanyStock::find($request->edit);
        }
        else
        {
            $subcompanystock=new CompanyStock();
        }
        $subcompanystock->subcompany_id = $request->subcompanyname;
        $subcompanystock->opening_balance = $request->opening_balance;
        $subcompanystock->save();
        return $subcompanystock;
    }

    public function getAllOpening()
    {
        $subcompanystock = CompanyStock::pluck('subcompany_id');
        // dd( $subcompanystock->toArray());
        $subcompany_name = SubCompany::select('id','name')->whereNotIn('id',$subcompanystock)->get();
        return $subcompany_name;
    }

    public function deleteSubCompanyStock($id)
    {
        $companystockid = CompanyStock::find($id);
        $companystockid->delete();
        return $companystockid;

    }


}
