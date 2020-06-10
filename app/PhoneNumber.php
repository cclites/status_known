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

    /********************************************************
     * RELATIONSHIPS
     ********************************************************/
    public function business(){
        return $this->belongsTo(Business::class);
    }

    /********************************************************
     * VALIDATION
     ********************************************************/
    public function validate(){}
}
