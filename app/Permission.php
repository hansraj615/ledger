<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    // use SoftDeletes;

    protected $fillable =['name','display_name','description'];

    protected $dates = ['deleted_at'];
}
