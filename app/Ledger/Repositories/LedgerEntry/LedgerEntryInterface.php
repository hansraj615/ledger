<?php

namespace App\Ledger\Repositories\LedgerEntry;

interface LedgerEntryInterface
{
     public function getAllLedger($subcompany);
     public function getAllClientSubCompany();
     public function getAllSubClient();
     public function storeLedgerEntry($request);
     public function getinvoicedetails($id);
     public function generatepdf($id);
     public function getallclientdetails($client_id);
     public function getClientDetailsAjax($request);

}

