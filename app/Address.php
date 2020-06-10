<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'type'
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
