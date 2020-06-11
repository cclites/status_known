<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\BusinessRequest;

/**
 * Class BusinessController
 * @package App\Http\Controllers\Business
 *
 * MAY NOT USE
 */
class BusinessController extends BaseController
{
    public function index(BusinessRequest $request)
    {
        $businesses = $this->businesses();
        return response()->json($businesses);
    }
}
