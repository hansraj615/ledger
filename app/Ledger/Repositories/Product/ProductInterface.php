<?php

namespace App\Ledger\Repositories\Product;

interface ProductInterface
{
    public function getAllProducts();
    public function storeProducts($request);
    public function findProduct($id);
    public function updateProducts($request,$id);
    public function deleteProduct($id);
    public function searchProduct($keyword = null);
    public function getProductName($id);
}

