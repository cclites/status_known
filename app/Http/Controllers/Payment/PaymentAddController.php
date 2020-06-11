<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PaymentUpdateRequest;
use App\Payment;

class PaymentAddController extends BaseController
{
    public function store(PaymentUpdateRequest $request)
    {
        Payment::create($request->validated());

        $payments = $this->payments();
        return response()->json($payments);
    }
}
