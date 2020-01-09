<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubCompany extends Model
{
    public $timestamps = false;
    protected $table = "user_sub_companies";

    public function subcompany()
    {
        return $this->belongsTo(SubCompany::class,'sub_company_id');
    }
}
