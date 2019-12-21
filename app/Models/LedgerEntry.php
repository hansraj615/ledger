<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    public function subcompany()
    {
        
        return $this->belongsTo(SubCompany::class,'subcompany_id');
       
    }

    public function stock()
    {
        return $this->belongsTo(CompanyStock::class);
    }

    
}
