<?php

namespace App\Ledger\Repositories\LedgerEntry;

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

class LedgerEntryRepository implements LedgerEntryInterface
{
    public function getAllLedger()
    {
        $ledger = LedgerEntry::all();
        return $ledger;
    }
    public function getAllClientSubCompany()
    {
        $subcompanies = ClientMapping::select('subcompany_id')->distinct()->get();
        return $subcompanies;
    }
    public function getAllSubClient()
    {
        $clients = ClientMapping::select('client_id')->get();
        return $clients;
    }
    public function searchSubCompany($keyword = null)
    {
        return  $subcompany_name =Country::where('country_name', 'like', '%'.$keyword.'%')->select('id', 'country_name')->limit(10)->get();
    }

    public function storeLedgerEntry($request)
    {
        // dd($request->all());
        $finaltotalamount="0";
        $amounthealth=0;
        $getfinalamount = LedgerEntry::where('subcompany_id','=', $request->subcompanyname)->orderBy('id', 'desc')->first();
        // dd($getfinalamount);
        if(!empty($getfinalamount))
        {
            $lastfinalamount = $getfinalamount->finalamount;

        } else {
            $getamount = CompanyStock::where('subcompany_id','=', $request->subcompanyname)->orderBy('id', 'desc')->first();
            $lastfinalamount = $getamount->opening_balance;
        }
        
        if($request->amounttype ==0)
        {
            $finaltotalamount=$lastfinalamount-($request->amount);
        }
        if($request->amounttype ==1)
        {
            $finaltotalamount=$lastfinalamount+$request->amount;
            //dd($finaltotalamount);
        }
        if($finaltotalamount<0)
        {
            $amounthealth="0";
        }
        else if($finaltotalamount==0)
        {
            $amounthealth="2";
        }
        else if($finaltotalamount>0)
        {
            $amounthealth ="1";
        }
        
        $ledgerentries = new LedgerEntry();
        $ledgerentries->subcompany_id = $request->subcompanyname;
        $ledgerentries->client_id = $request->clientname;
        $ledgerentries->amount_type = $request->amounttype;
        $ledgerentries->amount = $request->amount;
        $ledgerentries->finalamount = $finaltotalamount;
        $ledgerentries->amounthealth = $amounthealth;
      // dd($ledgerentries);
        $ledgerentries->save();
        return $ledgerentries;

    }

    
}
