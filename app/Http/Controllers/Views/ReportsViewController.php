<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsViewController extends Controller
{
    //Maybe not called at all?
    public function index(Request $request){
        $reports = \App\Report::all()->sortBy('id')->flatten();
        return response()->json($reports);
    }
}
