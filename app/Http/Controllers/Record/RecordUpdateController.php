<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\RecordRequest;
use App\Record;


class RecordUpdateController extends BaseController
{
    public function update(RecordRequest $request, Record $record)
    {
        return false;
    }
}
