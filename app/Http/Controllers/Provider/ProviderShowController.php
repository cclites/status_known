<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\ProviderRequest;
use App\Provider;
use Illuminate\Http\Request;

class ProviderShowController extends Controller
{
    public function show(Provider $provider, ProviderRequest $request){

        if($request->authorize()){
            return response()->json($provider);
        }else{
            return back(401, "You do not have permission to view this resource");
        }
    }
}
