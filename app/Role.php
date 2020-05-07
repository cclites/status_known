<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 'admin';
    const BUSINESS = 'business';
    const SYSTEM = 'system';
    const GUEST = 'guest';
}
