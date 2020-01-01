<?php

namespace App\Ledger\Repositories\Permission;

interface PermissionInterface
{
    public function getAll();

    public function find($id);

    public function create($request);

    public function update($id, $params);

    public function delete($id);

    public function getList();

    // public function getCount();
}
