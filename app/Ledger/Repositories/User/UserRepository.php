<?php

namespace App\Ledger\Repositories\User;

use App\Ledger\Repositories\User\UserInterface;
use App\User;
use App\Models\UserCompany;
use Illuminate\Support\Facades\DB;
use App\Ledger\Repositories\Permission\PermissionInterface;
use App\Models\Company;
use App\Models\UserSubCompany;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    /**
     * @var Role
     */
    private $role;
    private $permission;
    private $user;
    private $usercompany;
    private $usersubcompany;
    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(User $user,UserCompany $usercompany,UserSubCompany $usersubcompany){
        $this->user = $user;
        $this->usercompany = $usercompany;
        $this->usersubcompany = $usersubcompany;
    }

    // public function getAll($keyword = null)
    // {
    //     return $this->role->where(function($query) use ($keyword){

    //         if(!empty($keyword)){
    //             $query->where(function($q) use ($keyword)
    //             {
    //                 $q->where('name', 'LIKE', '%'. $keyword . '%');
    //                 $q->orWhere('display_name', 'LIKE', '%'. $keyword . '%');
    //                 $q->orWhere('description', 'LIKE', '%'. $keyword .'%');
    //             });
    //         }
    //     })
    //         ->orderBy('id')
    //         ->paginate(10);
    // }

    // public function find($id)
    // {
    //     return $this->role->with('permissions')->findOrFail($id);
    // }
    public function find($id)
    {
      return  $user = $this->user->select('name','email','id')->find($id);
    }
    public function create($request)
    {
         $user = $this->user;
         $usercompany = $this->usercompany;
         $usersubcompany = $this->usersubcompany;
         $user->name = $request->get('username');
         $user->email = $request->get('email');
         $user->password = Hash::make('password');
         $user->save();
         $usercompany->user_id = $user->id;
         $usercompany->company_id = $request->get('company');
         $usercompany->save();
         $usersubcompany->user_id = $user->id;
         $usersubcompany->sub_company_id = $request->get('subcompany');
         $usersubcompany->save();
        //  $user->company()->sync($request->get('company'));
        //  $user->subcompany()->sync($request->get('subcompany'));
         $user->roles()->attach($request->get('role'));
         return $user;

    }

    public function editUser($id)
    {
        // return $this->user->select('name','email','id')->find($id);
;        $user = $this->user->with(['roles'=> function($query){
            $query->select('role_id');
        }])->findorFail($id);
        return  $user;
    }

    public function update($id, $request)
    {
        $user = $this->user->find($id);
        $usercompany = $this->usercompany->where('user_id',$id)->delete();
        $usersubcompany = $this->usersubcompany->where('user_id',$id)->delete();
        $usercompany = $this->usercompany;
        $usersubcompany = $this->usersubcompany;
        $user->name = $request->get('username');
        $user->email = $request->get('email');
        $user->save();
        $usercompany->user_id = $user->id;
        $usercompany->company_id = $request->get('company');
        $usercompany->save();
        $usersubcompany->user_id = $user->id;
        $usersubcompany->sub_company_id = $request->get('subcompany');
        $usersubcompany->save();
       //  $user->company()->sync($request->get('company'));
       //  $user->subcompany()->sync($request->get('subcompany'));
        $user->roles()->sync($request->get('role'));
        return $user;
    }

    public function updatepassword($request)
    {
        // dd($request->all());
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                // return $user;
                Auth::logout();
                Toastr::success('password chnaged successfully');
                return redirect()->back();
            } else {
                Toastr::warning('New password cannot be the same as old password');
                return redirect()->back();
            }
        } else {
            Toastr::warning('Current password not match');
            return redirect()->back();
        }
    }

    public function deleteUser($id)
    {
        $user = $this->user->find($id);

        $user->delete();
    }


}
