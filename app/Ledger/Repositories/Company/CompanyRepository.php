<?php

namespace App\Ledger\Repositories\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyRepository implements CompanyInterface
{

    public function getAllCompany()
    {
        $company = Company::all();
        return $company;
    }

}
