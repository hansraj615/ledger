<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'display_name', 'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
