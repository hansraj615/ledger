<?php

namespace App\Ledger\Repositories\LedgerEntry;


use App\Models\Country;
use App\Models\City;
use App\Models\Client ;
use App\Models\ClientMapping;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\LedgerEntry;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LedgerEntryRepository implements LedgerEntryInterface
{
    public function getAllLedger()
    {
        $ledgers = LedgerEntry::distinct()->get();
        
        foreach($ledgers as $ledger)
        {
            $ledgerentrydetailsArray = [];
            $Client=Client::where('id',$ledger->client_id)->first();
            $ledgerentrydetailsArray[] = $Client->name;
            
            $ledgerClientTotalAmount=$this->getTotalClientAmount($ledger->client_id);
            $ledgerlatesttranaction=$this->getTransaction($ledger->client_id);
            $ledgerentrydetailsArray[]=$ledgerClientTotalAmount;
            $ledgerentrydetailsArray[]=$ledgerlatesttranaction;
            $ledgerentrymappingdetailsArray[] = $ledgerentrydetailsArray; 
          
        }
      //  dd($clientmappingdetailsArray);
        return $ledgerentrymappingdetailsArray;
    }

    public function getTotalClientAmount($client_id)
    {
        $clientid=intval($client_id);
        $clientcredit=LedgerEntry::where([['client_id',$clientid],['amount_type','1']])->sum('amount');
        $clientdebit=LedgerEntry::where([['client_id',$clientid],['amount_type','0']])->sum('amount');
        $clienttotalamount=$clientcredit- $clientdebit;
        return $clienttotalamount;
    }
    public function getTransaction($client_id)
    {
        $clientid=intval($client_id);
        $clienttranaction=LedgerEntry::select('amount','amount_type','description')->where([['client_id',$clientid]])->orderBy('id', 'desc')->take(2)->get();
        return  $clienttranaction;
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
        $finaltotalamount="0";
        $amounthealth=0;
        $getfinalamount = LedgerEntry::where('subcompany_id','=', $request->subcompanyname)->orderBy('id', 'desc')->first();
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
        $ledgerentries->description = $request->description;
        $ledgerentries->save();
        return $ledgerentries;

    }

    
}
