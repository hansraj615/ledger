<?php

namespace App\Ledger\Repositories\Product;

use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use App\Models\Product;
use App\Models\State;
use App\Models\SubCompany;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return $products;
    }



}
