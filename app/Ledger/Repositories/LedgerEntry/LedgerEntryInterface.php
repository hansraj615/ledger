<?php

namespace App\Ledger\Repositories\LedgerEntry;

interface LedgerEntryInterface
{
     public function getAllLedger();
     public function getAllClientSubCompany();
     public function getAllSubClient();
     //public function searchSubCompany($keyword = null);
     // public function editSubCompanyStock($id);
     // public function storeSubCompanyStock($request);
     // public function getAllOpening();
     // public function deleteSubCompanyStock($id);

    
}

