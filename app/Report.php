<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

    /*
    public function record(){
        return $this->hasOne(\App\Record::class, 'id', 'record_id');
    }*/

    public function requestedBy(){
        return $this->hasOne(\App\User::class, 'requested_by_id', 'id' );
    }

    public function invoice(){
        return $this->belongsTo(\App\Invoice::class);
    }
}
