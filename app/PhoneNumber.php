<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $fillable = [
        'type',
        'number',
        'contact_name'
    ];

    public function business(){
        return $this->belongsTo(Business::class);
    }
}
