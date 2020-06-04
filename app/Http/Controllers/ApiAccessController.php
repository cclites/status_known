<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
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
        $js = str_replace('%TOKEN%', $request->api_token, $js);
        return $js;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function gateway(Request $request)
    {
        $business = \App\Business::where('api_token', $request->api_token)->with('responsibleAgent')->first();

        $token = $request->api_token;
        /*
        $businessData = [
            'name' => $business->name,
            'api_token' => $business->api_token,
        ];

        $business = json_encode($businessData);
        */



        return view('form_view', compact('token', 'business'));
    }
}
