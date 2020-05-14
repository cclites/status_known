<?php

namespace App\Http\Controllers\Views;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\All\RecordsRequest;

//TODO: Move this stuff into a Base Request
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

use App\Record;

class RecordsViewController extends Controller
{
    //Maybe not called at all?
    public function index(Record $report, RecordsRequest $request){

        $recordsQuery = \App\Record::query();

        if(auth()->user()->hasRole(R::BUSINESS)){
            $recordsQuery->where('business_id', auth()->user()->business_id);
        }

        $records = $recordsQuery
                    ->orderBy('id')
                    ->with('created_by', 'business')
                    ->get()
                    ->map(function($record){

                        return [
                            'business_name' => $record->business->name,
                            'record_id' => $record->id,
                            'created_by' => $record->created_by->name,
                            'requested_for' => $record->first_name . " " . $record->last_name,
                            'request_date' => (new Carbon($record->created_at))->format('m-d-Y'),
                        ];

                    });

        return response()->json($records);
    }
}
