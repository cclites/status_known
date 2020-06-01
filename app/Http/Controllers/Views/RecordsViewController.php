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
    public function index(RecordsRequest $request){

        $recordsQuery = \App\Record::query();

        if($request->business && auth()->user()->hasRole(R::ADMIN)){
            $recordsQuery->where('business_id', $request->business);
        }

        if(auth()->user()->hasRole(R::BUSINESS)){
            $recordsQuery->where('business_id', auth()->user()->business_id);
        }

        if (auth()->user()->hasRole(R::ADMIN) && $request->record){
            $recordsQuery->where('id', $request->record);
        }

        if($request->start_date){

            $start_date = (new Carbon($request->start_date))->startOfDay();
            $end_date = (new Carbon($request->end_date))->endOfDay();

            $recordsQuery->whereBetween('created_at', [$start_date, $end_date]);
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
