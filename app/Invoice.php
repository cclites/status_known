<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'business_id',
        'amount',
        'tracking',
        'created_at'
    ];

    /********************************************************
     * RELATIONSHIPS
     ********************************************************/

    public function business(){
        return $this->belongsTo('\App\Business');
    }

    public function records(){
        return $this->hasOne('\App\Record', 'tracking', 'tracking');
    }

    public function reports(){
        return $this->hasOne('\App\Report', 'tracking', 'tracking');
    }
}
