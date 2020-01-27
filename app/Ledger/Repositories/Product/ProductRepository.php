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
    public function storeProducts($request)
    {
        $product = $this->product;
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->description = $request->description;
        $product->save();
        return $product;
    }

    public function findProduct($id)
    {
        $product = $this->product->findOrFail($id);
        return $product;
    }

    public function updateProducts($request,$id)
    {
        $product = $this->product->findOrFail($id);
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->description = $request->description;
        $product->save();
        return $product;
    }
    public function deleteProduct($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return $product;
    }
    public function searchProduct($keyword = null)
    {
        return  $products_name = $this->product->where('name', 'like', '%'.$keyword.'%')->select('id', 'name')->limit(10)->get();
    }

    public function getProductName($id)
    {
        return  $this->product->where('id',$id)->first();
    }


}
