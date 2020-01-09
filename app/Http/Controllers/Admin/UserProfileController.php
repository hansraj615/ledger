<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Company\CompanyInterface;
use App\Ledger\Repositories\Role\RoleInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use App\Ledger\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UpdatePasswordRequest;
use Brian2694\Toastr\Facades\Toastr;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index()
    {
        $user = $this->user->find(Auth::user()->id);
        return view('admin.userprofile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(UpdatePasswordRequest $request)
    {
        try {
        $updateuserpassword = $this->user->updatepassword($request);
        // Toastr::success(' Has been Updated');
        return redirect()->back();
        } catch (\Exception $e) {
            Toastr::success(''.$e->getMessage().' Error');
            return redirect()->back();
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
        //
    }
}
