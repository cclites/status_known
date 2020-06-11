<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProviderUpdateRequest;
use App\Provider;

class ProviderUpdateController extends BaseController
{
    public function update(ProviderUpdateRequest $request, Provider $provider){

        $provider->update($request->validated());

        $providers = $this->providers();
        return response()->json($providers);
    }
}
