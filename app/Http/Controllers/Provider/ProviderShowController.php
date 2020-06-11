<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\ProviderRequest;
use App\Provider;


class ProviderShowController extends BaseController
{
    public function show(Provider $provider, ProviderRequest $request)
    {
        return response()->json($provider);
    }
}
