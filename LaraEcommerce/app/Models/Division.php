<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $fillable = [
        'name',
        'priority',

    ];
    public function district(){
        // one to many relation        
        return $this->hasMany(District::class);
    }
}
