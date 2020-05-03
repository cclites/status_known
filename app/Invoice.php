<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class, 'business_id', 'id');
    }

    public function records(){
        return $this->hasMany(\App\Record::class, 'id', 'record_id');
    }

    public function reports(){
        return $this->hasMany(\App\Report::class, 'id', 'report_id');
    }
}
