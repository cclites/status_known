<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecksViewController extends Controller
{
    public function index(Request $request){

        return view_component('checksview-vue', 'ChecksView', [], []);
    }

}
