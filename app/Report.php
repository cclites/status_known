<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

    public function record(){
        return $this->hasOne(\App\Record::class);
    }

    public function requestedBy(){
        return $this->hasOne(\App\User::class, 'id', 'requested_by_id');
    }

    public function invoice(){
        return $this->belongsTo(\App\Invoice::class);
    }
}
