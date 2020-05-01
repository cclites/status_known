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
        return $this->belongsTo(\App\Provider::class);
    }

    public function invoice(){
        return $this->belongsTo(\App\Invoice::class);
    }

    public function createdBy(){
        return $this->hasOne(\App\User::class, 'id', 'created_by_id');
    }

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
