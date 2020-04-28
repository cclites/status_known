<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function business(){
        return $this->belongsTo(\App\Business::class);
    }

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
