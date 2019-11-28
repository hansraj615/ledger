<?php

namespace App\Ledger\Repositories\Company;

interface CompanyInterface
{
    public function getAllCompany();
    public function searchCountry($keyword = null);
    public function searchState($keyword = null,$request);
    public function searchCity($keyword = null,$request);
    public function storeCompany($request);
    public function editCompany($id);
}

