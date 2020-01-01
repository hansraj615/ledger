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
    public function getAllLedger($subcompany)
    {
        $ledgers = LedgerEntry::select('client_id')->where('subcompany_id',$subcompany)->distinct()->get();
        foreach($ledgers as $ledger)
        {
            $ledger['clientname']=Client::where('id',$ledger->client_id)->first();

            $ledger['clientTotalAmount']=$this->getTotalClientAmount($ledger->client_id,$subcompany);
            $getsubcompanystock = CompanyStock::select('opening_balance')->where('subcompany_id',$subcompany)->first();
            if($ledger['clientTotalAmount']+$getsubcompanystock->opening_balance > $getsubcompanystock->opening_balance)
            {
                $ledger['subcompanyhealth'] = 1;
            }else if($ledger['clientTotalAmount']+$getsubcompanystock->opening_balance == $getsubcompanystock->opening_balance){
                $ledger['subcompanyhealth'] = 2;
            }else{
                $ledger['subcompanyhealth'] = 0;
            }
            $ledger['latesttranaction']=$this->getTransaction($ledger->client_id,$subcompany);

        }
        return $ledgers;
    }

    public function getTotalClientAmount($client_id,$subcompany)
    {
        $clientid=intval($client_id);
        $clientcredit=LedgerEntry::where([['client_id',$clientid],['subcompany_id',$subcompany],['amount_type','1']])->sum('amount');
        $clientdebit=LedgerEntry::where([['client_id',$clientid],['subcompany_id',$subcompany],['amount_type','0']])->sum('amount');
        $clienttotalamount=$clientcredit- $clientdebit;
        return $clienttotalamount;
    }
    // public function getClientType($client_id)
    // {
    //     $clientid=intval($client_id);
    //     $clientamounttype=LedgerEntry::where([['client_id',$clientid]])->get;
    //     return $clientamounttype;
    // }
    public function getTransaction($client_id,$subcompany)
    {
        $clientid=intval($client_id);
        $clienttranaction=LedgerEntry::select('amount','amount_type','description')->where([['client_id',$clientid],['subcompany_id',$subcompany]])->orderBy('id', 'desc')->take(2)->get();
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
        // dd($request->subcompanyname);
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
