<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use Illuminate\Http\Request;

class ApiAccessController extends Controller
{
    /**
     * @param Request $request
     * @return false|string|string[]
     */
    public function loader(Request $request)
    {
        $js = file_get_contents(public_path('js/gate.js'));
        $js = str_replace('%TOKEN%', $request->token, $js);
        return $js;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function gateway(Request $request)
    {
        $business = \App\Business::where('id', \Auth::user()->business_id)->first();
        return view('form_view', compact('request', 'business'));
    }
}
