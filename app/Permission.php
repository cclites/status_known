<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    const CAN_READ = 'can_read';
    const CAN_UPDATE = 'can_update';
    const CAN_CREATE = 'can_create';
    const CAN_DELETE = 'can_delete';

}
