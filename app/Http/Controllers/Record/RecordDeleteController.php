<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\RecordRequest;
use App\Record;

class RecordDeleteController extends BaseController
{
    public function destroy(RecordRequest $request, Record $record)
    {
        $record->delete();

        $records = $this->records();
        return response()->json($records);
    }
}
