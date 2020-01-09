<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCompany extends Model
{
    //

    Public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');

    }

    public function getNameCodeAttribute()
    {

        return $this->name && $this->subcompany_code?$this->name.'['.$this->subcompany_code.']':'-';
    }
}
