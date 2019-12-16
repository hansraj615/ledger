<?php

namespace App\Ledger\Repositories\SubCompanyStock;

interface SubCompanyStockInterface
{
     public function getSubComanyStock();
     public function editSubCompanyStock($id);
     public function storeSubCompanyStock($request);
     public function getAllOpening();
     public function deleteSubCompanyStock($id);

    
}

