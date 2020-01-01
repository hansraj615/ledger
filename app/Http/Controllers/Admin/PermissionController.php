<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ledger\Repositories\Permission\PermissionInterface;
use App\Http\Requests\Permission\StorePermissionRequest;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->getAll();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
             $this->permission->create($request);
             DB::commit();
             return redirect()->route('permissions.index')->with('success', 'Permission registered successfully');
        } catch (\Exception $e) {
            DB::rollback();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Permission registration failed');
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
    public function edit($id, Request $request)
    {
        $permission = $this->permission->find($id);
        return view('admin.permissions.edit', compact('permission'));
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
            $permission = $this->permission->update($id, $request);
            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission details updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Permission details updating failed');
        }
    }

    // public function getList()
    // {dd(12);
    //     $permissions = $this->permission->getList();
    //     return $permissions;
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permission->delete($id);
            DB::commit();

            return redirect()->route('permissions.index')
                ->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->route('permissions.index')
                ->with('error', 'Permission delete failed');
        }
    }
}
