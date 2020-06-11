<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\RecordRequest;

class RecordController extends BaseController
{
    public function index(RecordRequest $request)
    {
        //This will need a transformation also

        $records = $this->records();
        return response()->json($records);
    }

}
