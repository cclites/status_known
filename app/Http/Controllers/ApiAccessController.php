<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use Illuminate\Http\Request;

class ApiAccessController extends Controller
{
    public function loader(Request $request){

        $js = file_get_contents(public_path('js/gate.js'));
        $js = str_replace('%TOKEN%', $request->token, $js);

        return $js;
    }

    public function gateway(Request $request){
        return view('form_view', compact('request'));
    }

    public function requestRecord(RecordRequest $request){

    }
}
