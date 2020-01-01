<?php

namespace App\Ledger\Repositories\Permission;

use App\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements PermissionInterface
{
    /**
     * @var Permission
     */
    private $permission;

    /**
     * PermissionRepository constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll()
    {
        return  $this->permission->all();
    }

    public function find($id)
    {
        return $this->permission->findOrFail($id);
    }

    public function create($request)
    {
        $permission = $this->permission;

        $permission->name = $request->get('name');

        $permission->display_name = $request->get('display_name');

        $permission->description = $request->get('description');

        $permission->save();

        return $permission;
    }

    public function update($id, $request)
    {
        $permission = $this->permission->find($id);

        $permission->name = $request->get('name');

        $permission->display_name = $request->get('display_name');

        $permission->description = $request->get('description');

        $permission->save();

        return $permission;
    }

    public function delete($id)
    {
        $permission = $this->permission->find($id);
        $permission->delete();
    }

    public function getList()
    {
       return $this->permission->pluck('display_name', 'id');
        // return $this->permission->get();
    }

//     public function getCount()
//     {
//         return $this->permission->count();
//     }
}
