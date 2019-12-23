<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $fillable = [
        'name',
        'division_id',


    ];
    public function division(){
        // one to one relation
        
        return $this->belongsTo(Division::class);
    }
}
