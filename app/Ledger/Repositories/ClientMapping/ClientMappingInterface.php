<?php

namespace App\Ledger\Repositories\ClientMapping;

interface ClientMappingInterface
{
    
     public function getAllMapping();
     public function storeClientMapping($request);
     public function searchSubClient($keyword = null);
     public function editClientMapping($id);
     public function deleteClientMapping($id);

    
}

