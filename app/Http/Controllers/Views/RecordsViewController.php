<?php

namespace App\Http\Controllers\Views;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//All = view all records


//TODO: Move this stuff into a Base Request
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

use App\Record;
use App\Http\Requests\Model\RecordRequest;

class RecordsViewController extends Controller
{
    public function index(RecordRequest $request){

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
                    ->with('createdBy', 'business')
                    ->get()
                    ->map(function($record){

                        $record = $record->toArray();

                        return [
                            'business_name' => $record['business']['name'],
                            'tracking_id' => $record['tracking'],
                            'requested_by' => $record['created_by']['name'],
                            'requested_for' => $record['last_name'] . ", " . $record['first_name'],
                            'request_date' => (new Carbon($record['created_at']))->format('m-d-Y g:i:s'),
                            'record_id' => $record['id'],
                        ];

                    });

        return response()->json($records);
    }
}
