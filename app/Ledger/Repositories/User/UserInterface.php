<?php

namespace App\Ledger\Repositories\User;

interface UserInterface
{
    // public function getAll();

    public function editUser($id);

    public function create($request);

    public function update($id, $request);
    public function find($id);

    public function deleteUser($id);

    public function updatepassword($request);

    // public function getRolePermissionIds($id);

    // public function getList();

    // public function getCount();

    // public function getRoleIdByName($name);

    // public function getSuperAdminList();

    // public function getAgentRoles($roleName);
}
