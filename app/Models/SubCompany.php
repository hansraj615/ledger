<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCompany extends Model
{
    //

    Public function company()
    {
        return $this->belongsTo(Company::class,'id');

    }

    public function getNameCodeAttribute()
    {

        return $this->name && $this->subcompany_code?$this->name.'['.$this->subcompany_code.']':'-';
    }
}
