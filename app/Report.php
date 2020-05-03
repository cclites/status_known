<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /********************************************************
     * RELATIONSHIPS
     ********************************************************/
    public function business(){
        return $this->belongsTo('\App\Business');
    }

    public function record(){
        return $this->hasOne('\App\Record', 'id', 'record_id');
    }

    public function requested_by(){
        return $this->hasOne('\App\User', 'id', 'requested_by_id' );
    }
}
