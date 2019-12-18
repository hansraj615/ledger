<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientMapping extends Model
{
    public function subcompany()
    {
        
        return $this->belongsTo(SubCompany::class,'subcompany_id');
        //return $this->hasMany(SubCompany::class);
    } 

    public function client()
    {
       //return $this->belongsTo(Client::class,'client_id');
        return $this->belongsTo(Client::class);
    }
}
