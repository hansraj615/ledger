<?php

namespace App\Ledger\Repositories\Api\Company;

interface CompanyApiInterface
{
    public function getCompanyApi($id);
    public function editCompanyApi($request,$id);
    public function updateCompanyApi($request,$id);
    // public function searchCountry($keyword = null);
    // public function searchState($keyword = null,$request);
    // public function searchCity($keyword = null,$request);
    // public function searchSubCompany($keyword = null,$request);
    // public function storeCompany($request);
    // public function editCompany($id);
    // public function deleteCompany($id);
    // public function getAllCompanyList();
}

