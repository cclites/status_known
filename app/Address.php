<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function business(){
        return $this->belongsTo(Business::class);
    }
}
