<?php

namespace App\Ledger\Repositories\Client;

interface ClientInterface
{
     public function getClient();
     public function storeClient($request);
     public function editClient($id);
     public function deleteClient($id);
    
}

