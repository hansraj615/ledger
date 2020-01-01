<?php

namespace App\Ledger\Repositories\Role;

interface RoleInterface
{
    public function getAll();

    // public function find($id);

    public function create($request);

    public function update($id, $request);

    // public function delete($id);

    // public function getRolePermissionIds($id);

    // public function getList();

    // public function getCount();

    // public function getRoleIdByName($name);

    // public function getSuperAdminList();

    // public function getAgentRoles($roleName);
}
