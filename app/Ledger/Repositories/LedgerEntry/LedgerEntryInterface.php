<?php

namespace App\Ledger\Repositories\LedgerEntry;

interface LedgerEntryInterface
{
     public function getAllLedger();
     public function getAllClientSubCompany();
     public function getAllSubClient();
     public function storeLedgerEntry($request);
    
    
}

