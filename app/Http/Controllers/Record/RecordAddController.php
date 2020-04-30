<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use Illuminate\Http\Request;

class RecordAddController extends Controller
{
    public function request(RecordRequest $request){

        //Here we create and save a Record record, populated with
        //provider id (there will only be one), business_id, and tracking.
        //The request object only has the search parameters. In order to save
        //the record, need to append other things there.

        /*
'created_by_id' => 'required|numeric',
'provider_id' => 'required|numeric',
'invoice_id' => 'nullable|numeric',
'business_id' => 'required|numeric',
'amount' => 'nullable|numeric',
'data' => 'nullable',
'tracking' => 'nullable|string|max:32',
*/

    }
}
