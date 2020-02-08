<?php

namespace App\Ledger\Repositories\LedgerLogin;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LedgerLoginRepository implements LedgerLoginInterface
{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function find($id)
    {
        return $this->user::find($id);
    }
    public function findUser($id)
    {
        return $this->user::find($id);
    }
    public function getData($request)
    {
        $rowUserData = $this->user->where("email", $request['email'])->first();
        $response = ['message' => 'Email and Password not valid'];
            if (!empty($rowUserData)) {
                if (Hash::check($request['password'], $rowUserData->password)) {
                    return $response = $this->ledgerProfile($rowUserData->id);
                }

            $response = ['message' => 'Email and Password not valid'];
        }
        return $response;
    }

    public function ledgerProfile($id)
    {
        $lprofile = $this->find($id);
        if (!empty($lprofile)) {
            return [
                'id' => $lprofile->id,
                'user_id' => $id,
                'user_email' => $lprofile->email,
                'name' => $lprofile->name,
            ];
        } else {
            return [];
        }
    }

    public function isLoggedIn($id, $dafault = false)
    {
        $ledgerObject = $this->find($id);
        if (!$dafault) {
            return $ledgerObject->is_logged_in;
        } else {
            $ledgerObject->is_logged_in = 1;
            $ledgerObject->save();
            return $ledgerObject->is_logged_in;
        }
    }

    public function checkPassword($request, $userId)
    {
        $userObject = $this->find($userId);
        if (!Hash::check($request->old_password, $userObject->password)) {

            abort(400, trans('errors.LEDGER_123'));
        }
        if ($request->new_password != $request->confirm_password) {
            abort(400, trans('errors.LEDGER_125'));
        }
        $userObject->password = Hash::make($request->confirm_password);
        if ($userObject->save()) {
            $this->isLoggedOut($userId, true);
            return ['message' => trans('success.LEDGER_115')];
        } else {
            abort(400, trans('errors.LEDGER_123'));
        }
    }

    public function isLoggedOut($id, $dafault = false)
    {
        $userObject = $this->find($id);
        if (!$dafault) {
            return $userObject->is_logged_in;
        } else {
            $userObject->is_logged_in = 0;
            $userObject->save();
            return $userObject->is_logged_in;
        }
    }

}
