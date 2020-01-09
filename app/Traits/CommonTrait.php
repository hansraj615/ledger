<?php
namespace App\Traits;

use App\Models\Company;
use App\Models\Product;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

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
        return Product::count();
    }

}
