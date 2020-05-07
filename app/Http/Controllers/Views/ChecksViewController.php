<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecksViewController extends Controller
{
    public function index(){
        $records = \App\Record::all()->sortBy('id')->flatten();
        return response()->json($records);
    }

}
