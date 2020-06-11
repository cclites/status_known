<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProviderUpdateRequest;
use App\Provider;


class ProviderDeleteController extends BaseController
{
    public function destroy(ProviderUpdateRequest $request, Provider $provider)
    {
        $provider->delete();

        $providers = $this->providers();
        return response()->json($providers);
    }
}
