<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyStock extends Model
{
    //

    public function subCompany()
    {
        return $this->belongsTo(SubCompany::class,'id');

    }
}
