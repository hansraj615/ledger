<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;
use Zizaco\Entrust\EntrustFacade as Entrust;


class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function updatePassword(User $user)
    {
        return Entrust::can('user-change-password') ? true : false;
    }

    // public function changeAgentRole(User $user)
    // {
    //     return (Entrust::hasRole(['superAdminNDTV','superAdminFortisIT','superAdminSalesOffice','hospitalLevelAdmin','unitITAdmin']) && Entrust::can('change-agent-role')) ? true : false;
    // }
}
