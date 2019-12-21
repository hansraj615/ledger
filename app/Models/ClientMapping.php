<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientMapping extends Model
{
    public function subcompany()
    {
        
        return $this->belongsTo(SubCompany::class,'subcompany_id');
        
    } 

    public function client()
    {
        return $this->hasMany(Client::class,'id');
    }
}
