<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'ssn',
        'created_by_id',
        'provider_id',
        'business_id',
        'invoice_id',
        'amount',
        'data',
        'tracking'
    ];

    public function provider(){
        return $this->hasOne(\App\Provider::class, 'id', 'provider_id');
    }

    public function invoice(){
        return $this->hasOne(\App\Invoice::class, 'id', 'invoice_id');
    }

    public function createdBy(){
        return $this->hasOne(\App\User::class, 'id', 'created_by_id');
    }

    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

}
