<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Permission as P;
use App\Record;
use App\Role as R;
use Illuminate\Http\Request;

class RecordCreateController extends Controller
{
    public function create(RecordRequest $request){

        $record = new Record($request->all());

        //\Log::info("Hit the request controller");
        \Log::info(json_encode($record));

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

        {"first_name":"wqeqwe","middle_name":"qweqwe","last_name":"qweqweq","dob":"2020-04-10","ssn":"123121325","token":"$2y$10$6tNghZbPaxdQ9qFTx3G3hOsCwt6R.Xb5YlaWVj68LJbI2QUHerMMG"}

*/

    }
}


