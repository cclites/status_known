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

    /********************************************************
     * RELATIONSHIPS
     ********************************************************/

    public function business(){
        return $this->belongsTo('\App\Business');
    }

    public function report(){
        return $this->hasOne('\App\Report', 'tracking', 'tracking');
    }

    public function provider(){
        return $this->hasOne('\App\Provider', 'id', 'provider_id');
    }

    public function invoice(){
        return $this->hasOne('\App\Invoice', 'tracking', 'tracking');
    }

    public function createdBy(){
        return $this->hasOne('\App\User', 'id', 'created_by_id');
    }



}
