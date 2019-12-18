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

    
}
