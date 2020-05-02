<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

    public function records(){
        return $this->hasMany(\App\Record::class);
    }

    public function reports(){
        return $this->hasMany(\App\Report::class);
    }
}
