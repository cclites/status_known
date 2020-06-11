<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProviderUpdateRequest;
use App\Provider;

class ProviderAddController extends BaseController
{
    public function create(ProviderUpdateRequest $request)
    {
        Provider::create($request->validated());

        $providers = $this->providers();
        return response()->json($providers);
    }
}
