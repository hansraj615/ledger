<?php

namespace App\Ledger\Repositories\LedgerEntry;

use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\Product\ProductInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use App\Models\Country;
use App\Models\Client ;
use App\Models\ClientMapping;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\LedgerEntry;
use App\Models\State;
use App\Models\SubCompany;
use Exception;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LedgerEntryRepository implements LedgerEntryInterface
{
    private  $ledgerentries;
    private $product;
    private $client;
    private $subcompany;

    public function __construct(LedgerEntry $ledgerentries,ProductInterface $product,ClientInterface $client,SubCompanyInterface $subcompany)
    {
        $this->ledgerentries = $ledgerentries;
        $this->product = $product;
        $this->client = $client;
        $this->subcompany = $subcompany;
    }
    public function getAllLedger($subcompany)
    {
        $ledgers = LedgerEntry::select('client_id')->where('subcompany_id',$subcompany)->distinct()->get();
        foreach($ledgers as $ledger)
        {
            $ledger['clientname'] = Client::where('id',$ledger->client_id)->pluck('name','id');
            $ledger['clientTotalAmount'] = $this->getTotalClientAmount($ledger->client_id,$subcompany);
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

    public function getTransaction($client_id,$subcompany)
    {
        try{
            $lasttransatsations = $this->ledgerentries
            ->where([['client_id',$client_id],['subcompany_id',$subcompany]])
            ->distinct()
            ->select('amount_type','transation_id')
            ->orderBy('transation_id','Desc')
            ->take(5)
            ->get();
            foreach($lasttransatsations as $lasttransatsation)
            {
                $lasttransatsation['totalamout'] = $this->ledgerentries->where([['client_id',$client_id],['subcompany_id',$subcompany],['transation_id',$lasttransatsation->transation_id]])->sum('amount');
            }
            return  $lasttransatsations;
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
    public function getAllClientSubCompany()
    {
        $subcompany = \App\Traits\CommonTrait::getUserSubCompanyId();
        $subcompanies = ClientMapping::select('subcompany_id')->where('subcompany_id',$subcompany)->distinct()->get();
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
        try{
        $finaltotalamount="0";
        $amounthealth=0;
        $transation_id = LedgerEntry::select('transation_id')->orderBy('transation_id','desc')->first();
        if(!empty($transation_id)){
            $transation = $transation_id->transation_id;
            $transation = $transation + 1;
        } else{
            $transation = 1;
        }
        $getfinalamount = LedgerEntry::where('subcompany_id','=', $request->subcompanyname)->orderBy('id', 'desc')->first();
        if(!empty($getfinalamount))
        {
            $lastfinalamount = $getfinalamount->finalamount;

        } else {
            $getamount = CompanyStock::where('subcompany_id','=', $request->subcompanyname)->orderBy('id', 'desc')->first();
            $lastfinalamount = $getamount->opening_balance;
        }
        foreach($request->product as $key=>$product){

            $ledgerentries = new LedgerEntry();
            $ledgerentries->subcompany_id = $request->subcompanyname;
            $ledgerentries->client_id = $request->clientname;
            $ledgerentries->amount_type = $request->amounttype;
            $ledgerentries->product_id = $request->product[$key];
            $ledgerentries->price = $request->price[$key];
            $ledgerentries->quantity = $request->quantity[$key];
            $ledgerentries->amount = $request->amount[$key];
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
                $finaltotalamount=$lastfinalamount-($request->amount[$key]);
            }
            if($request->amounttype ==1)
            {
                $finaltotalamount=$lastfinalamount+$request->amount[$key];
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
            $ledgerentries->finalamount = $finaltotalamount;
            $ledgerentries->amounthealth = $amounthealth;
            $ledgerentries->description = $request->description[$key];
            $ledgerentries->transation_id = $transation;
            $ledgerentries->save();
        }
    }catch(Exception $e){
        dd($e->getMessage());

    }

    }

    public function getinvoicedetails($id)
    {
        $getinvoices = $this->ledgerentries->where('transation_id',$id)->get();
        foreach($getinvoices as $getinvoice){
        $getinvoice['productname'] = $this->product->getProductName($getinvoice->product_id);
        $getinvoice['clientname'] = $this->client->getClientName($getinvoice->client_id);
        $getinvoice['subcompanyname'] = $this->subcompany->getSubcompanyName($getinvoice->subcompany_id);
        $getinvoice['totalamout'] = $this->ledgerentries->where('transation_id',$id)->sum('amount');
        }
        // dd($getinvoice['totalamout']);
        return $getinvoices;
    }

    public function generatepdf($id)
    {
        $data = $this->ledgerentries::get();
        return $data;

    }


}
