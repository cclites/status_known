<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessViewController extends Controller
{
    public function index(Request $request){

        return view_component('businessview-vue', 'BusinessView', [], []);
    }

}