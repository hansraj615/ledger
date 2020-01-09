<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 1/6/17
 * Time: 12:17 PM
 */

namespace App\Ledger\Helpers;

use App\Models\SubCompany;

class customHelper
{
    public static function getsubcompanyName($value)
    {
        if($value!=''|| $value!=null){
        $subcompany = SubCompany::select('name')->findOrFail($value);
        }
         return $subcompany->name??"";
    }
}
