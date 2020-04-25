<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function invoice(){
        return $this->hasMany(\App\Invoice::class);
    }

    public function responsibleAgent(){
        return $this->hasOne(User::class, 'id', 'responsible_agent_id');
    }

    public function account(){
        return $this->hasOne(Account::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
