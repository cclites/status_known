<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

    public function invoice(){
        return $this->belongsTo(\App\Invoice::class);
    }
}
