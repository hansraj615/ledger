<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Product\ProductInterface;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }
    public function index()
    {
        $products = $this->product->getAllProducts();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $product = $this->product->storeProducts($request);
        }
        catch(\Exception $e){
            return redirect()->back()->with('danger', $e->getMessage());
        }
        Toastr::Warning('Product Successfully Added :)','Success');
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function searchProduct($keyword=null)
    {
        $products = $this->product->searchProduct($keyword);
        $productArray=[];
        foreach ($products as $productkey=>$product){
            $productArray[$productkey]['id']=$product->id;
            $productArray[$productkey]['text']=$product->name;
        }
        return $productArray;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->findProduct($id);
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $product = $this->product->updateProducts($request,$id);
            }
            catch(\Exception $e){
                return redirect()->back()->with('danger', $e->getMessage());
            }
            Toastr::Warning('Product Successfully Updated :)','Success');
            return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $delete_product = $this->product->deleteProduct($id);
        }catch(\Exception $e){
            return redirect()->route('products.index')->with('danger', $e->getMessage());
        }
        Toastr::Warning('Product Successfully Deleted :)','Success');
        return redirect()->route('products.index');
    }
}
