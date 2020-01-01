<?php

namespace App\Ledger\Repositories\Role;

// use App\Ledger\Repositories\User\UserInterface;
use App\Role;
use Illuminate\Support\Facades\DB;
use App\Ledger\Repositories\Permission\PermissionInterface;

class RoleRepository implements RoleInterface
{
    /**
     * @var Role
     */
    private $role;
    private $permission;
    private $user;
    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role, PermissionInterface $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        // $this->user = $user;
    }

    public function getAll($keyword = null)
    {
        return $this->role->where(function($query) use ($keyword){

            if(!empty($keyword)){
                $query->where(function($q) use ($keyword)
                {
                    $q->where('name', 'LIKE', '%'. $keyword . '%');
                    $q->orWhere('display_name', 'LIKE', '%'. $keyword . '%');
                    $q->orWhere('description', 'LIKE', '%'. $keyword .'%');
                });
            }
        })
            ->orderBy('id')
            ->paginate(10);
    }

    public function find($id)
    {
        return $this->role->with('permissions')->findOrFail($id);
    }

    public function create($request)
    {
        $role = $this->role;

        $role->name = $request->get('name');

        $role->display_name = $request->get('display_name');

        $role->description = $request->get('description');
        $role->save();

        $role->permissions()->attach($request->get('permissions'));

        return $role;
    }

    public function update($id, $request)
    {
        $role = $this->role->find($id);

        $role->name = $request->get('name');

        $role->display_name = $request->get('display_name');

        $role->description = $request->get('description');

        $role->save();

        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }

    public function delete($id)
    {
        $role = $this->role->find($id);

        $role->delete();
    }

    public function getRolePermissionIds($role)
    {
        $rolePermissionIds = [];

        foreach ($role->permissions as $permission) {
            $rolePermissionIds[] = $permission->id;
        }

        return $rolePermissionIds;
    }

    public function getList()
    {
        return $this->role->pluck('display_name', 'id');
    }

    public function getCount()
    {
        return $this->role->count();
    }

    public function getRoleIdByName($name)
    {
        return $this->role->where('name',$name)->pluck('id')->first();
    }

    public function getSuperAdminList(){

        if($this->user->isSuperAdminNDTV()){
            return $this->role->whereIn('name',['superAdminFortisIT','superAdminSalesOffice','superAdminRegional','financeNDTV','superAdminNDTV'])->get()->pluck('display_name','name');
        }
        return $this->role->whereIn('name',['superAdminFortisIT','superAdminSalesOffice','superAdminRegional'])->get()->pluck('display_name','name');
    }

    public function getAgentRoles($roleName)
    {
        return $this->role->whereNotIn('name',['superAdminFortisIT','superAdminSalesOffice','superAdminRegional','financeNDTV','superAdminNDTV','doctor', $roleName])
                ->get()->pluck('display_name','name');
    }
}
