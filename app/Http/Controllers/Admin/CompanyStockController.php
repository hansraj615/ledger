<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\SubCompanyStock\SubCompanyStockInterface;
use Exception;
use Brian2694\Toastr\Facades\Toastr;

class CompanyStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $subcompanystock;

    public function __construct(SubCompanyStockInterface $subcompanystock)
    {
            $this->subcompanystock = $subcompanystock;
    }
    public function index()
    { 
        try
        {
           $subcompanystockleft = $this->subcompanystock->getSubComanyStock();
        //    dd($subcompanystockleft);
        }
        catch(\Exception $e)
        {
            Toastr::danger($e->getMessage() ,'Danger');
            return redirect()->route('subcompanystock.index')->with('danger', $e->getMessage());
        }
        return view('admin.subcompanystock.index',compact('subcompanystockleft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $subcomanystock=$this->subcompanystock->getAllOpening();
        return view('admin.subcompanystock.create',compact('subcomanystock'));
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
        $subcompanystock = $this->subcompanystock->storeSubCompanyStock($request);
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->route('subcompanystock.index')->with('danger', $e->getMessage());
        }
        if(!empty($request->edit))
        {
            Toastr::success(''.$request->input('subcompany_name').' Has Been Updated');
        }
        else{
            Toastr::success("New SubCompanyStock  ".$request->input('name')." Has Been Created");
    
        }
        return redirect()->route('subcompanystock.index')->with('danger','created');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        try
        {
            $subcompanystock=$this->subcompanystock->editSubCompanyStock($id);
        }
        catch(\Exception $e){
            return redirect()->route('subcompanystock.index')->with('danger', $e->getMessage());
        }
        return view('admin.subcompanystock.edit',compact('subcompanystock'));
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
        //
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
            $delete_subcompanystock = $this->subcompanystock->deleteSubCompanyStock($id);
        }catch(\Exception $e)
        {
           return redirect()->route('subcomanystock.index')->with('danger',$e->getMessage());
        }
        Toastr::Warning('SubCompanyStock Successfully Deleted :','Success');
        return redirect()->route('subcompanystock.index');
    }
}
