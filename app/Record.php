<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function provider(){
        return $this->belongsTo(\App\Provider::class);
    }

    public function invoice(){
        return $this->belongsTo(\App\Invoice::class);
    }

    public function createdBy(){
        return $this->hasOne(\App\User::class, 'id', 'created_by_id');
    }
}
