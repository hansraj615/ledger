<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AllRoleRrequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\EditRoleRrequest;
use App\Http\Requests\Role\ShowRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Ledger\Repositories\Role\RoleInterface;
use Illuminate\Support\Facades\DB;
use App\Ledger\Repositories\Permission\PermissionInterface;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $permission;

    /**
     * RoleController constructor.
     * @param RoleInterface $role
     * @param PermissionInterface $permission
     */
    public function __construct(RoleInterface $role,PermissionInterface $permission)
    {
        $this->role = $role;

        $this->permission = $permission;
    }
    public function index(AllRoleRrequest $request)
    {
        // $keyword = $request->get('search') ? trim($request->get('search')) : null;

        $roles = $this->role->getAll();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRoleRequest $request)
    {
        $permissions = $this->permission->getList();
        return view('admin.roles.create', compact('permissions'));
        // return view('errors.403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->role->create($request);
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Role registration failed');
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
    public function edit($id ,EditRoleRrequest $request)
    {
        try {
            $role = $this->role->find($id);
            $permission_list = $this->permission->getList();
            $permission = $this->role->getRolePermissionIds($role);
            return view('admin.roles.edit', compact('role', 'permission_list', 'permission'));
        }catch(\Exception $e)
        {
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Role Edit Error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->role->update($id, $request);
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Role Update failed');
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
