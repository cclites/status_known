<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\ProviderRequest;
use App\Provider;

class ProviderController extends BaseController
{
    public function index(ProviderRequest $request)
    {
        $providers = $this->providers();
        return response()->json($providers);
    }
}
