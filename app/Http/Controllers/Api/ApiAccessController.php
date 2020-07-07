<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ReportRequest;

use App\Http\Controllers\Controller;

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
        $js = str_replace('%PATH%', env('API_BASE_PATH'), $js);
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

        return view('form_view', compact('token', 'business'));
    }
}
