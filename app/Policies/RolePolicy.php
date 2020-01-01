<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Zizaco\Entrust\EntrustFacade as Entrust;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return (Entrust::hasRole(['admin','owner']) && Entrust::can('list-role')) ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return (Entrust::hasRole(['admin','owner']) && Entrust::can('create-role')) ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return (Entrust::hasRole(['admin','owner']) && Entrust::can('edit-role')) ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    // public function show(User $user)
    // {
    //     return (Entrust::hasRole(['admin','owner','general-user']) && Entrust::can('show-company')) ? true : false;
    // }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return (Entrust::hasRole(['owner']) && Entrust::can('delete-role')) ? true : false;
    }
}
