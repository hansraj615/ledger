<?php

namespace App\Ledger\Repositories\SubCompany;

interface SubCompanyInterface
{
    public function getAllSubCompany();
    public function editSubCompany($id);
    public function searchCountry($keyword = null);
    public function searchState($keyword = null,$request);
    public function searchCity($keyword = null,$request);
    public function storeSubCompany($request);
    public function getCompany();
    public function deleteSubCompany($id);
    public function getAllSubCompanyList();
}

