<?php
namespace App\Traits;

use App\Models\Client;
use App\Models\Company;
use App\Models\CompanyStock;
use App\Models\LedgerEntry;
use App\Models\Product;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Eloquent;
trait CommonTrait
{
    public static function getUserCompany($value)
    {
        return Auth::user()->usercompany->company->name;
    }
    public static function getUserSubCompany($value)
    {
        return Auth::user()->usersubcompany->subcompany->name;
    }

    public static function getUserCompanyId()
    {
        return Auth::user()->usercompany->company->id;
    }
    public static function getUserSubCompanyId()
    {
        return Auth::user()->usersubcompany->subcompany->id;
    }

    public static function getTotalProduct()
    {
       $product = Product::all();
        if(count($product)>0)
        {
            return count($product);
        }else{
            return 0;
        }
    }
    // public static function getTotalCompany()
    // {
    //     // $company_id = $this->getUserCompanyId();
    //     // dd($company_id);
    // //    $company = Company::where('id',$company_id)->get();
    // //     if(count($company)>0)
    // //     {
    // //         return count($company);
    // //     }else{
    // //         return 0;
    // //     }
    // }

    // public static function getTotalSubCompany()
    // {
    //     return SubCompany::count();
    // }

    // public static function getTotalClient()
    // {
    //     return Client::count();
    // }

    // public static function getTotalLedgerEntry()
    // {
    //     return LedgerEntry::count();
    // }

    // public static function getTotalCompanyStock()
    // {
    //     return CompanyStock::count();
    // }

}
