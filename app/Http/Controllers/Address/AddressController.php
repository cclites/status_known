<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Model\AddressRequest;
use App\Http\Requests\Update\AddressUpdateRequest;
use App\Address;


class AddressController extends BaseController
{

    /**
     * @param AddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AddressRequest $request)
    {
        $addresses = $this->addresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(AddressRequest $request, Address $address)
    {
        return response()->json($address);
    }

    /**
     * @param AddressUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(AddressUpdateRequest $request)
    {
        Address::create($request->validated());

        $addresses = $this->addresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->update($request->validated());

        $addresses = $this->addresses();
        return response()->json($addresses);
    }

    /**
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(AddressUpdateRequest $request, Address $address)
    {
        $address->delete();

        $addresses = $this->addresses();
        return response()->json($addresses);
    }

}
