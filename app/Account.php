<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'business_id',
        'account_name',
        'account_number',
        'card_number',
        'tracking'
    ];


    /********************************************************
     * RELATIONSHIPS
     ********************************************************/
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

}
