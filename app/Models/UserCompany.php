<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    //
    public $timestamps = false;
    protected $table = "user_companies";

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
