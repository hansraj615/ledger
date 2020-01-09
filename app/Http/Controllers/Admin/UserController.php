<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Company\CompanyInterface;
use App\Ledger\Repositories\Role\RoleInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use App\Ledger\Repositories\User\UserInterface;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $company;
    private $subcompany;
    private $user;
    private $role;

    public function __construct(CompanyInterface $company,SubCompanyInterface $subcompany,UserInterface $user,RoleInterface $role){
        $this->company = $company;
        $this->subcompany = $subcompany;
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->company->getAllCompanyList();
        $subcompanies = $this->subcompany->getAllSubCompanyList();
        foreach($companies as $company){
            $company_array[$company->id] =  $company->name;
          }
        foreach($subcompanies as $subcompany){
        $subcompany_array[$subcompany->id] =  $subcompany->name;
        }
        $roles = $this->role->getList();
        return view('admin.users.create',compact('company_array','subcompany_array','companies','subcompanies','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
             $this->user->create($request);
             DB::commit();
             return redirect()->route('user.index')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'User registration failed');
        }
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
        try{
            $user = $this->user->editUser($id);
            $companies = $this->company->getAllCompanyList();
        $subcompanies = $this->subcompany->getAllSubCompanyList();
        foreach($companies as $company){
            $company_array[$company->id] =  $company->name;
          }
        foreach($subcompanies as $subcompany){
        $subcompany_array[$subcompany->id] =  $subcompany->name;
        }
        $roles = $this->role->getList();
        } catch(\Exception $e){
            return redirect()->route('user.index')->with('danger', $e->getMessage());
        }
        return view('admin.users.edit',compact('user','company_array','subcompany_array','companies','subcompanies','roles'));
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
        DB::beginTransaction();
        try {
             $this->user->update($id,$request);
             DB::commit();
             return redirect()->route('user.index')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'User registration failed');
        }
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
            $delete_user = $this->user->deleteUser($id);
        }catch(\Exception $e){
            return redirect()->route('user.index')->with('danger', $e->getMessage());
        }
        Toastr::Warning('User Successfully Deleted :)','Success');
        return redirect()->route('user.index');
    }
}
