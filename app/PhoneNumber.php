<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    public function business(){
        return $this->belongsTo(Business::class);
    }
}
