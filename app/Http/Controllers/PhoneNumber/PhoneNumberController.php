<?php

namespace App\Http\Controllers\PhoneNumber;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\PhoneNumberRequest;
use App\Http\Requests\Update\PhoneNumberUpdateRequest;
use App\PhoneNumber;

class PhoneNumberController extends BaseController
{
    /**
     * @param PhoneNumberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PhoneNumberRequest $request)
    {
        $phoneNumbers = $this->phoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function show(PhoneNumberRequest $request, PhoneNumber $phoneNumber)
    {
        return response()->json($phoneNumber);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     */
    public function create(PhoneNumberUpdateRequest $request)
    {
        PhoneNumber::create($request->validated());

        $phoneNumbers = $this->phoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function update(PhoneNumberUpdateRequest $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->update($request->validated());

        $phoneNumbers = $this->phoneNumbers();
        return response()->json($phoneNumbers);
    }

    /**
     * @param PhoneNumberUpdateRequest $request
     * @param PhoneNumber $phoneNumber
     */
    public function delete(PhoneNumberUpdateRequest $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();

        $phoneNumbers = $this->phoneNumbers();
        return response()->json($phoneNumbers);
    }

}
