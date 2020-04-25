<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }
}
